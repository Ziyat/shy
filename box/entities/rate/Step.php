<?php

namespace box\entities\rate;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $step
 * @property string $description
 */
class Step extends ActiveRecord
{
    public static function create(int $step, string $description): self
    {
        $percent = new static();
        $percent->step = $step;
        $percent->description = $description;
        return $percent;
    }

    public function edit(int $step, string $description): void
    {
        $this->step = $step;
        $this->description = $description;
    }

    public function isEqualTo(int $id): bool
    {
        return $this->id === $id;
    }

    public static function tableName(): string
    {
        return '{{%rate_steps}}';
    }
}
