<?php


namespace frontend\models;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class TransferForm extends Model
{

    public $user;
    public $sum;

    public function rules()
    {
        return [
            [['user', 'sum'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'user' => 'Пользователь',
            'sum' => 'Сумма',
        ];
    }


    public function getUser(){
        $client = new \GuzzleHttp\Client(['base_url' => 'http://exchange.local']);

        if(!Yii::$app->user->isGuest){
            $responses = $client
                ->request('GET', 'http://exchange.local/v1/user/view?id='. Yii::$app->user->identity->id.'')
                ->getBody();
            $responses = json_decode($responses, true);
        }else{
            $responses = null;
        }


        $users = $client
            ->request('GET', 'http://exchange.local/v1/user/index')
            ->getBody();
        $users = json_decode($users, true);

        foreach ($users as $key => $user){
            if($user['id'] == $responses['id']){
                unset($users[$key]);
            }
        }

        return ArrayHelper::map($users,'id','name');
    }
}