<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $orderForm app\modules\order\forms\OrderCreateForm */

$this->title = 'Введите свои реквизиты';
$this->params['breadcrumbs'][] = 'Модуль Счёт';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-default-form">
    <?php $form = ActiveForm::begin([
        'id' => 'order-buyer-form',
        'options' => [
            'class' => 'form-horizontal',
        ],
    ]); ?>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <h1><?= $this->title ?></h1>
            </div>
        </div>

        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'name', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'name', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'address', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'address', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'inn', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'inn', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'kpp', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'kpp', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'checking_ac', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'checking_ac', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'corresp_ac', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'corresp_ac', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'bik', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'bik', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'bank', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'bank', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <h2>Введите сумму</h2>
            </div>
        </div>
        <div class="form-group">
            <?= Html::activeLabel($orderForm, 'price', ['class'=>'control-label col-sm-2']) ?>
            <?= $form->field($orderForm, 'price', ['options'=>['class'=>'col-sm-10']])->label(false)->textInput(['size'=>255]) ?>
        </div>
        <?= $form->field($orderForm, 'seller_id', ['options'=>[]])->label(false)->hiddenInput() ?>
        <?= $form->field($orderForm, 'service_id', ['options'=>[]])->label(false)->hiddenInput() ?>
        <?= $form->field($orderForm, 'quantity', ['options'=>[]])->label(false)->hiddenInput() ?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('Сгенерировать счёт', ['class'=>'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
