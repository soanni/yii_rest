<?php

namespace frontend\components;

use yii\base\Widget;
use yii\web\JqueryAsset;

class ClockWidget extends Widget
{
    public function init()
    {
        JqueryAsset::register($this->getView());
    }

    public function run(){
        return $this->render('clock');
    }
}