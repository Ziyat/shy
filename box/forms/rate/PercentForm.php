<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\rate;

use yii\base\Model;

class PercentForm extends Model
{
    public $step;
    public $value;

    public function rules()
    {
        return [
            [['step', 'value'], 'required'],
            ['step', 'integer'],
            ['value', 'double'],
        ];
    }
}