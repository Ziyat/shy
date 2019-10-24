<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\services\manage\rate;

use box\entities\rate\Rate;
use box\forms\rate\RateForm;
use box\repositories\RateRepository;

/** @property RateRepository $rates */

class RateManageService
{
    private $rates;

    public function __construct(RateRepository $rateRepository)
    {
        $this->rates = $rateRepository;
    }

    /**
     * @param RateForm $form
     * @return int
     * @throws \DomainException
     */
    public function create(RateForm $form)
    {
        $rate = Rate::create($form->name, $form->description, $form->sum);
        foreach ($form->percents as $percent) {
            $rate->attachPercent($percent->step, $percent->value);
        }
        $this->rates->save($rate);
        return $rate->id;
    }

    /**
     * @param Rate $rate
     * @param RateForm $form
     * @throws \DomainException
     */
    public function update(Rate $rate, RateForm $form)
    {
        $rate->edit($form->name, $form->description, $form->sum);
        $this->rates->save($rate);
    }

    /**
     * @param $id
     * @throws \DomainException
     * @throws \LogicException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function remove($id)
    {
        $rate = $this->rates->get($id);
        $this->rates->remove($rate);
    }
}