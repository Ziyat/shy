<?php

namespace box\entities\rate;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Rate model
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $expired_at
 * @property float $sum
 * @property Percent[] $percents
 */
class Rate extends ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_ARCHIVE = 20;

    public static function create($name, $description, $sum): self
    {
        $rate = new static();
        $rate->name = $name;
        $rate->description = $description;
        $rate->sum = $sum;
        $rate->status = self::STATUS_ACTIVE;
        return $rate;
    }

    public function edit($name, $description, $sum): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->sum = $sum;
    }

    public function attachPercent($step, $value)
    {
        $percents = $this->percents;
        $percents[] = Percent::create($step, $value);
        $this->percents = $percents;
    }

    /**
     * @param $step
     * @return float
     */
    public function percentByStep(int $step): float
    {
        if ($percent = $this->getPercents()->where(['step_id' => $step])->one()) {
            return $percent->value;
        }
        return 0;
    }

    public function getPercents(): ActiveQuery
    {
        return $this->hasMany(Percent::class, ['rate_id' => 'id']);
    }

    /**
     * @throws \DomainException
     */
    public function active()
    {
        if ($this->isActive()) {
            throw new \DomainException('Статус уже активный');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @throws \DomainException
     */
    public function archive()
    {
        if ($this->isArchive()) {
            throw new \DomainException('Статус уже архивный');
        }
        $this->status = self::STATUS_ARCHIVE;
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isArchive()
    {
        return $this->status == self::STATUS_ARCHIVE;
    }

    public function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_ARCHIVE => 'Архивный',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['percents']
            ]
        ];
    }

    public static function tableName()
    {
        return '{{%rates}}';
    }
}
