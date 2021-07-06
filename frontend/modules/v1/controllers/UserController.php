<?php


namespace frontend\modules\v1\controllers;


use common\models\UserItem;
use frontend\modules\v1\models\Balance;
use frontend\modules\v1\models\History;
use yii\filters\Cors;
use yii\rest\ActiveController;
use frontend\modules\v1\models\User;

class UserController extends ActiveController
{

    public function actions()
    {
        $actions = parent::actions();

        // отключаем
        unset($actions['index']);
        unset($actions['view']);


        return $actions;
    }

    public function behaviors() {

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),

        ];

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::class,
            'formatParam' => '_format',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
                'xml' => \yii\web\Response::FORMAT_XML
            ],
        ];

        return $behaviors;
    }

    public $modelClass = User::class;

    public function actionIndex(){

        $users = User::find()->all();

        return $users;
    }

    public function actionView($id){
        $user = User::findOne($id);

        return $user;
    }

    public function actionTransfer($to_user_id, $whom_user_id, $sum){
        $balance = new Balance();

        $to_user = $balance->toUser($to_user_id);
        $whom_user = $balance->whomUser($whom_user_id);

        if(!isset($whom_user)){
            return ['message' => 'Что-то пошло не так! попробуйте позже'];
        }
        elseif((isset($to_user)) && ($to_user->balance < $sum)){
            return ['message' => 'Пополните баланс'];
        }
        elseif ($to_user->balance >= $sum){
            if($balance->updateBalanceUser($to_user, $to_user_id, $whom_user, $whom_user_id, $sum)){
                return ['message' => 'Успешно'];
            }
        }
        else{
            return ['message' => 'Что-то пошло не так! попробуйте позже'];
        }

        //return true;
    }


}