<?php

/* @var $this yii\web\View */
/* @var $seller app\modules\order\entities\OrderSeller */
/* @var $buyer app\modules\order\entities\OrderBuyer */
/* @var $param app\modules\order\entities\OrderParam */
/* @var $order app\modules\order\entities\OrderOrder */

$this->title = 'Генерация счёта';
$this->params['breadcrumbs'][] = 'Модуль Счёт';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-default-generate">
    <h1><?= $this->title ?></h1>

    <hr>

    <?= $this->renderFile('@app/modules/order/views/default/_item.php', [
        'model' => $order,
    ]); ?>
</div>
