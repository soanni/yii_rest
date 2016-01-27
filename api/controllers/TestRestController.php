<?php

namespace api\controllers;

use yii\filters\VerbFilter;
use yii\rest\Controller;

class TestRestController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get']
            ]
        ];
        return $behaviors;
    }

    public function actionIndex(){
        return $this->dataList();
    }

    private function dataList(){
        return [
            ['id' => 1, 'name' => 'Albert', 'surname' => 'Einstein'],
            ['id' => 2, 'name' => 'Enzo', 'surname' => 'Ferrari'],
            ['id' => 3, 'name' => 'Mario', 'surname' => 'Bros']
        ];
    }
}