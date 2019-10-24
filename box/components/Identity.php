<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\components;

use box\entities\user\User;
use box\repositories\reads\UserReadRepository;
use yii\web\IdentityInterface;

/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 * Class Identity
 * @package box\components
 */
class Identity implements IdentityInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
//        $data = self::getOauth()->getServer()->getResourceController()->getToken();
//        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getUserDetails($username): array
    {
        $user = self::getRepository()->findActiveByUsername($username);
        return ['user_id' => $user->id];
    }

    private static function getRepository(): UserReadRepository
    {
        return \Yii::$container->get(UserReadRepository::class);
    }
}