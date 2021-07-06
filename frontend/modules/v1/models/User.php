<?php

namespace frontend\modules\v1\models;

use common\models\Balance;
use common\models\UserItem;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class User extends \common\models\User
{


    public function fields() {

        $fields = parent::fields();

        // удаляем небезопасные поля из user
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);

        $fields = array_merge($fields, ['surname', 'name', 'middleName', 'userBalance']);

        return $fields;

    }


    //User Item
    public function getProfile(){
        return $this->hasOne(UserItem::className(),['user_id' => 'id']);
    }

    public function getSurname() {
        if(!empty($this->profile->surname)){
            return $this->profile->surname;
        }
        return  null;
    }

    public function getName() {
        if(!empty($this->profile->name)){
            return $this->profile->name;
        }
        return null;
    }

    public function getMiddleName() {
        if(!empty($this->profile->middle_name)){
            return $this->profile->middle_name;
        }
        return null;
    }

    //Balance

    public function getBalance(){
        return $this->hasOne(Balance::className(), ['user_id' => 'id']);
    }

    public function getUserBalance(){
        return $this->balance->balance;
    }

}