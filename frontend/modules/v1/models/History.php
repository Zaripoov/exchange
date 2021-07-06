<?php


namespace frontend\modules\v1\models;


class History extends \common\models\History
{
    public function fields() {

        $fields = parent::fields();

        

        return $fields;

    }

    //User Item
    public function getProfile(){
        return $this->hasOne(User::className(),['user_id' => 'id']);
    }

}