<?php

namespace frontend\controllers;

use frontend\models\Room;
use yii\web\Controller;


class TestCarouselController extends Controller
{
    public function actionIndex()
    {
        $models = Room::find()->limit(4)->all();
        return $this->render('index',compact('models'));
    }
}