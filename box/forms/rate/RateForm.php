<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\rate;

use box\entities\rate\Step;
use box\forms\CompositeForm;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * @property PercentForm $percents
 */
class RateForm extends CompositeForm
{
    public $name;
    public $description;
    public $sum;

    public function __construct(array $config = [])
    {
        $this->percents = array_map(function () {
            return new PercentForm();
        }, Step::find()->orderBy('step')->all());
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'sum'], 'required'],
            [['name', 'description'], 'string'],
            [['sum'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
          'name' => 'Имя',
          'description' => 'Описание',
          'sum' => 'Первоначальная сумма',
        ];
    }

    protected function internalForms(): array
    {
        return ['percents'];
    }
}
