<?php

namespace api\controllers;

use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use Yii;


class RoomsController extends ActiveController
{
    public $modelClass = 'common\models\Room';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => [$this,'httpBasicAuthHandler']
                ],
                [
                    'class' => QueryParamAuth::className(),
                    'tokenParam' => 'myAccessToken'
                ]
            ]

        ];
        return $behaviors;
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

    public function actionAccessTokenByUser($username, $hash){
        $accessToken = null;
        $user = User::findOne(['username' => $username, 'password_hash' => $hash]);
        if($user != null){
            $accessToken = Yii::$app->security->generateRandomString();
            $user->access_token = $accessToken;
            $user->save();
        }
        return compact('accessToken');
    }
}