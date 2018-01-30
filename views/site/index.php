<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Привет!</h1>

        <p><?= Html::a('Вставить свои реквизиты', ['order/default/add'], ['class'=>'btn btn-primary']) ?></p>
    </div>
</div>
