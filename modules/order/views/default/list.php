<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\order\search\OrderOrderSearch */

?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'options' => [
        'id'    => 'order-list',
        'class' => 'order-list',
    ],
]) ?>
