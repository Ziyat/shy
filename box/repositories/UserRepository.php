<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\repositories;


use box\entities\user\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    /**
     * @param $id
     * @return User
     * @throws NotFoundHttpException
     */
    public function get($id): User
    {
        if (!$user = User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE])) {
            throw new NotFoundHttpException('User not found.');
        }
        return $user;
    }

    /**
     * @param User $user
     * @throws \DomainException
     */
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \DomainException('User save error.');
        }
    }

    /**
     * @param User $user
     * @throws \DomainException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \DomainException('User delete error.');
        }
    }
}