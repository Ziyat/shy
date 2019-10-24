<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\repositories;


use box\entities\rate\Rate;
use yii\web\NotFoundHttpException;

class RateRepository
{
    /**
     * @param $id
     * @return Rate
     * @throws NotFoundHttpException
     */
    public function get($id): Rate
    {
        if (!$rate = Rate::findOne(['id' => $id, 'status' => Rate::STATUS_ACTIVE])) {
            throw new NotFoundHttpException('Rate not found.');
        }
        return $rate;
    }

    /**
     * @param Rate $rate
     * @throws \DomainException
     */
    public function save(Rate $rate): void
    {
        if (!$rate->save()) {
            throw new \DomainException('Rate save error.');
        }
    }

    /**
     * @param Rate $rate
     * @throws \DomainException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Rate $rate): void
    {
        if (!$rate->delete()) {
            throw new \DomainException('Rate delete error.');
        }
    }
}