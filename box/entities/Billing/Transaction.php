<?php

namespace box\entities\Billing;

use yii\db\ActiveRecord;

/**
 * Class Transaction
 * @package box\entities\Billing
 * @property int $id
 * @property string $debit_credit
 * @property float $amount
 * @property int $created_at
 * @property int $updated_at
 */
class Transaction extends ActiveRecord
{
    public const DEBIT = 'debit';
    public const CREDIT = 'credit';

    public static function tableName()
    {
        return '{{%transactions}}';
    }
}
