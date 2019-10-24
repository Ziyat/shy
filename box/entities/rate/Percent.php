<?php

namespace box\entities\rate;

use yii\db\ActiveRecord;

/**
 * @property integer $rate_id
 * @property integer $step_id
 * @property float $value
 * @property Step $step
 *
 */
class Percent extends ActiveRecord
{
    public static function create(int $stepId, float $value): self
    {
        $percent = new static();
        $percent->step_id = $stepId;
        $percent->value = $value;
        return $percent;
    }

    public function edit(int $stepId, float $value): void
    {
        $this->step_id = $stepId;
        $this->value = $value;
    }

    public function getStep()
    {
        return $this->hasOne(Step::class, ['id' => 'step_id']);
    }

    public static function tableName()
    {
        return '{{%rate_percents}}';
    }
}
