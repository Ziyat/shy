<?php
namespace frontend\widgets;

use yii\bootstrap\Widget;

class AnalyticsCodes extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('analytics-codes');
    }
}