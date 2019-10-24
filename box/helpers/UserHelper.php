<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\helpers;

use box\entities\user\Profile;
use box\entities\user\User;
use Yii;
use yii\helpers\Html;

class UserHelper
{

    public static function badge($value, $class = 'success')
    {
        return Html::tag('span', $value, ["class" => "label label-$class"]);
    }

    public static function getPhoneLink(string $phone = null)
    {
        return $phone ? Html::a($phone, 'tel:' . str_replace([' ', '-'], '', $phone)) : "Не указано";
    }

    /**
     * @param $gender
     * @return bool|string
     * @throws \yii\base\InvalidArgumentException
     */
    public static function getGenderIcon($gender)
    {
        $fileName = $gender == Profile::SEX_MALE ? 'man.jpg' : 'woman.jpg';
        return Yii::getAlias("@icons/$fileName");
    }

    public static function getPartners(User $main)
    {
        $children = $main->children;

        $lftCount = 0;
        $rgtCount = 0;
        if (self::isTwoChild($children)) {
            $lftCount = $children[0]->getDescendants(null, true)->count();
            $rgtCount = $children[1]->getDescendants(null, true)->count();
        }
        if (self::isOneChild($children)) {
            $lftCount = $children[0]->getDescendants(null, true)->count();
        }
        return (object)[
            'lft' => (int)$lftCount,
            'rgt' => (int)$rgtCount,
        ];
    }

    private static function isTwoChild($children)
    {
        return count($children) === 2;
    }

    private static function isOneChild($children)
    {
        return count($children) === 1;
    }
}
