<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<div class="site-index">
    <?php if(!Yii::$app->user->isGuest): ?>
    Пользователь: <?= $responses['surname'] ?> <?= $responses['name'] ?> <?= $responses['middleName'] ?><br>
    Баланс: <?= $responses['userBalance'] ?>
    <h3>Перевести</h3>

        <?= \Yii::$app->session->getFlash('success'); ?>

    <div class="row">
        <?php if(!empty($message)): ?>
            <p><?= $message['message']; ?></p>
        <?php endif ?>
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($transfer, 'user')->dropDownList(\frontend\models\TransferForm::getUser(),['prompt' => 'Укажите пользователя']); ?>

                <?= $form->field($transfer, 'sum')->textInput(); ?>


                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php else: ?>
    Зарегайся
    <?php endif; ?>
</div>
