<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\widgets;

use box\entities\user\User;
use box\helpers\UserHelper;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class NestedSetsWidget extends Widget
{
    public $items;

    public function run()
    {
        $level = 0;
        $genealogy = null;
        foreach ($this->items as $n => $user) {
            /** @var User $user */
            if ($user->depth == $level) {
                $genealogy .= Html::endTag('div') . "\n";
            } elseif ($user->depth > $level) {
                $genealogy .= Html::beginTag('div', ['class' => 'branch lv' . $level]) . "\n";
            } else {
                $genealogy .= Html::endTag('div') . "\n";
                for ($i = $level - $user->depth; $i; $i--) {
                    $genealogy .= Html::endTag('div') . "\n";
                    $genealogy .= Html::endTag('div') . "\n";
                }
            }

            if ($user->isSingle()) {
                $genealogy .= Html::beginTag('div', ['class' => 'entry sole']);
            } else {
                $genealogy .= Html::beginTag('div', ['class' => 'entry']);
            }
            $genealogy .= Html::beginTag('a', [
                'class' => 'md-chip md-chip-raised',
                'data-toggle' => 'tooltip',
                'title' => $user->profile->fullName,
                'href' => Url::to(['/user/view', 'id' => $user->id]),
            ]);

            $genealogy .= Html::tag('div', Html::img(UserHelper::getGenderIcon($user->profile->sex)), ['class' => 'md-chip-icon']);
            $genealogy .= $user->profile->given_name;
            $genealogy .= Html::endTag('a') . "\n";
            $level = $user->depth;
        }

        for ($i = $level; $i; $i--) {
            $genealogy .= Html::endTag('li') . "\n";
            $genealogy .= Html::endTag('ul') . "\n";
        }

        return $genealogy;
    }
}
