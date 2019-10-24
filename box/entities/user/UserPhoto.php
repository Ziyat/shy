<?php

namespace box\entities\user;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "user_photos".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file
 * @property int $sort
 *
 * @property User $user
 * @mixin ImageUploadBehavior
 */
class UserPhoto extends ActiveRecord
{

    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName()
    {
        return '{{%user_photos}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 'auto'],
                    'thumb' => ['width' => 1000, 'height' => 'auto'],
                ],
                'filePath' => '@uploads/store/documents/[[attribute_user_id]]/[[id]].[[extension]]',
                'fileUrl' => '@uploadsUrl/store/documents/[[attribute_user_id]]/[[id]].[[extension]]',
                'thumbPath' => '@uploads/cache/documents/[[attribute_user_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@uploadsUrl/cache/documents/[[attribute_user_id]]/[[profile]]_[[id]].[[extension]]',
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
