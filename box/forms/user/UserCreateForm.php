<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\user;

use box\entities\user\User;
use box\forms\CompositeForm;
use yii\helpers\ArrayHelper;

/**
 * @property string $username;
 * @property string $password;
 * @property int $status;
 * @property int $parent_id;
 *
 * @property ProfileForm $profile;
 */
class UserCreateForm extends CompositeForm
{
    public $username;
    public $password;
    public $status;
    public $parent_id;

    public function __construct(User $user = null, array $config = [])
    {
        if ($user) {
            $this->username = $user->username;
            $this->password = $user->password;
            $this->status = $user->status;
            $this->parent_id = $user->parent->id;
            $this->profile = new ProfileForm($user->profile);
        }
        $this->profile = new ProfileForm();
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['parent_id', 'integer'],
            ['parent_id', 'default', 'value' => 1],

            ['status', 'default', 'value' => User::STATUS_ACTIVE],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_DELETED]],
        ];
    }

    public function getStatusList()
    {
        return [
            User::STATUS_ACTIVE => 'Активный',
            User::STATUS_DELETED => 'Удалён',
        ];
    }

    public function getUsersList()
    {
        return ArrayHelper::map(User::find()->where(['status' => User::STATUS_ACTIVE])->orderBy('lft')->all(), 'id', function (User $user) {
            return $user->profile->fullName;
        });
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'parent_id' => 'Спонсор',
            'status' => 'Состояние',
        ];
    }

    protected function internalForms(): array
    {
        return ['profile'];
    }
}