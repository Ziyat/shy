<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\user;

use yii\base\Model;

class UserChangeParentForm extends Model
{
    public $from;
    public $to;

    public function rules()
    {
        return [
            [['from', 'to'], 'required'],
            [['from', 'to'], 'integer']
        ];
    }
}