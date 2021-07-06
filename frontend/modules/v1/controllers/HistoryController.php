<?php


namespace frontend\modules\v1\controllers;


use common\models\History;
use frontend\modules\v1\models\User;
use yii\filters\Cors;
use yii\rest\ActiveController;

class HistoryController extends ActiveController
{

    public function actions()
    {
        $actions = parent::actions();

        // отключаем
        unset($actions['index']);


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

    public $modelClass = History::class;

    public function actionIndex(){

        $histories = History::find()->all();

        return $histories;
    }


}