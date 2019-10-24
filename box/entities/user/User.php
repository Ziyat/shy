<?php

namespace box\entities\user;

use box\entities\queries\UserQuery;
use box\entities\rate\Rate;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use paulzi\nestedsets\NestedSetsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $role
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 *
 * @property User $parent
 * @property User[] $parents
 * @property User[] $children
 * @property User[] $descendants
 * @property User $prev
 * @property User $next
 *
 * @mixin NestedSetsBehavior
 *
 * @property Profile $profile
 * @property UserPhoto[] $photos
 * @property UserPhoto $mainPhoto
 *
 * @property UserRateReference $rateReference
 * @property Rate $rate
 */
class User extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @return int|string
     */
    public function balance()
    {
        $step = $this->step();
        if ($this->rate) {
            $balance = $this->rate->sum * pow(2, $step) / 100 * $this->rate->percentByStep($step);
            return number_format($balance);
        }
        return 0;
    }

    public function step()
    {
        $users = $this->getDescendants()->orderBy('lft')->all();
        $step = 0;
        $mainDepth = $this->depth;
        $levels = ArrayHelper::getColumn($users, function ($q) use ($mainDepth) {
            return $q->depth - $mainDepth;
        });
        $levels = array_count_values($levels);
        foreach ($levels as $k => $level) {
            if ($k == 1 && $level == 2) {
                $step++;
            } else if (pow(2, $k) == $level) {
                $step++;
            }
        }
        return $step;
    }

    /**
     * @param $username
     * @param $password
     * @param $status
     * @param Profile $profile
     * @return static
     * @throws \yii\base\Exception
     */
    public static function create($username, $password, $status, Profile $profile)
    {
        $user = new static();
        $user->username = $username;
        $user->setPassword($password);
        $user->status = $status;
        $user->generateAuthKey();
        $user->profile = $profile;
        return $user;
    }

    public function setRate($id)
    {
        $reference = UserRateReference::create($this->id, $id);
        $this->rateReference = $reference;
    }

    public function changeTo($lft, $rgt, $depth)
    {
        $this->lft = $lft;
        $this->rgt = $rgt;
        $this->depth = $depth;
    }

    // Photos

    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photos;
        $photos[] = UserPhoto::create($file);
        $this->updatePhotos($photos);
    }

    /**
     * @param $id
     * @throws \DomainException
     */
    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    /**
     * @param $id
     * @throws \DomainException
     */
    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    /**
     * @param $id
     * @throws \DomainException
     */
    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i] = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(UserPhoto::class, ['user_id' => 'id'])->orderBy('sort');
    }

    public function getMainPhoto(): ActiveQuery
    {
        return $this->hasOne(UserPhoto::class, ['id' => 'main_photo_id']);
    }

    public function isAdmin()
    {
        return $this->role === 'administrator';
    }

    public function isFullTree()
    {
        return (int)$this->getChildren()->count() === 2;
    }

    public function isSingle()
    {
        return ((int)$this->getPrev()->count()) === 0 && ((int)$this->getNext()->count()) === 0;
    }

    public function isOneChild()
    {
        return ((int)$this->getChildren()->count()) === 1;
    }

    public function getProfile(): ActiveQuery
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }


    public function getRateReference(): ActiveQuery
    {
        return $this->hasOne(UserRateReference::class, ['user_id' => 'id']);
    }

    public function getRate()
    {
        return $this->hasOne(Rate::class, ['id' => 'rate_id'])->via('rateReference');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => NestedSetsBehavior::class,
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['profile', 'photos', 'rateReference']
            ]
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @param $password
     * @return bool
     * @throws \yii\base\InvalidArgumentException
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            foreach ($this->photos as $photo) {
                $photo->delete();
            }
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'status' => 'Состояние',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'fullName' => 'Полное имя',
        ];
    }
}
