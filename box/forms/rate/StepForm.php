<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\rate;


use yii\base\Model;

class StepForm extends Model
{
    public $step;
    public $description;

    public function rules()
    {
        return [
            ['step', 'required'],
            ['step', 'integer'],
            ['description', 'string'],
        ];
    }
}