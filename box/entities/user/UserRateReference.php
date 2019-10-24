<?php

namespace box\entities\user;

use yii\db\ActiveRecord;

/**
 * Rate model
 *
 * @property integer $user_id
 * @property integer $rate_id
 */
class UserRateReference extends ActiveRecord
{
    public static function create($user_id, $rate_id): self
    {
        $reference = new static();
        $reference->user_id = $user_id;
        $reference->rate_id = $rate_id;
        return $reference;
    }

    public static function tableName()
    {
        return '{{%user_rate_reference}}';
    }
}
