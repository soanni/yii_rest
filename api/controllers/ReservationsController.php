<?php

namespace api\controllers;

use common\models\Reservation;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use common\models\User;

class ReservationsController extends ActiveController
{
    public $modelClass = 'common\models\Reservation';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'indexWithRooms' => ['get']
            ]
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this,'httpBasicAuthHandler']
        ];
        return $behaviors;
    }

    public function actionIndexWithRooms()
    {
        $reservations = Reservation::find()->all();
        $out = [];
        foreach($reservations as $r){
            $out[] = array_merge($r->attributes, ['room' => $r->room->attributes]);
        }
        return $out;
    }

    public function httpBasicAuthHandler($username, $password){
        $out = null;
        $user = User::findOne(['username' => $username]);
        if($user != null){
            if($user->validatePassword($password)){
                $out = $user;
            }
        }
        return $out;
    }
}