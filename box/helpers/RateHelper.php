<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\helpers;

use box\entities\rate\Rate;
use yii\helpers\ArrayHelper;

class RateHelper
{
    public static function getRateList()
    {
        return ArrayHelper::map(Rate::find()->asArray()->all(), 'id', 'name');
    }

}