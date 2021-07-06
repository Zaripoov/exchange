<?php


namespace frontend\modules\v1\models;


use yii\base\BaseObject;

class Balance extends \common\models\Balance
{

    public function searchBalance(){
        return Balance::find();
    }

    public function toUser($to_user_id){
        return $this->searchBalance()->where(['user_id' => $to_user_id])->one();
    }

    public function whomUser($whom_user_id){
        return $this->searchBalance()->where(['user_id' => $whom_user_id])->one();
    }

    public function updateBalanceUser($to_user, $to_user_id, $whom_user, $whom_user_id, $sum){
        $history = new History();
        $to_user->balance = $to_user->balance - $sum;
        if($to_user->update()){
            $history->balance = $sum;
            $history->to_user_id= $to_user_id;
            $history->whom_user_id = $whom_user_id;
            if($history->save()){
                $whom_user->balance = $whom_user->balance + $sum;
                $whom_user->update();
                return true;
            }
        }
    }

}