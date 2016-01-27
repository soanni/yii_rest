<?php

namespace frontend\controllers;

use frontend\models\Room;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class RoomsController extends Controller
{
    public function actionIndex(){
        $data = new ActiveDataProvider([
            'query' => Room::find(),
            'pagination' => ['pageSize' => 20]
        ]);

        return $this->render('index',compact('data'));

    }
}