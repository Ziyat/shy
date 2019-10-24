<?php
namespace common\fixtures;

use box\entities\user\User;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}