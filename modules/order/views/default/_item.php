<?php

/* @var $this yii\web\View */
/* @var $model app\modules\order\entities\OrderOrder */

$buyer = $model->buyer;
$seller = $model->seller;
$param = $model->param;

?>

<div class="row">
    <div class="col-md-12">
        <?= $seller->getAttributeLabel('name') ?>:
        <?= $seller->name ?><br />

        <?= $seller->getAttributeLabel('address') ?>:
        <?= $seller->address ?><br />

        <?= $seller->getAttributeLabel('inn') ?>:
        <?= $seller->inn ?><br />

        <?= $seller->getAttributeLabel('checking_ac') ?>:
        <?= $seller->checking_ac ?><br />

        <?= $seller->getAttributeLabel('corresp_ac') ?>:
        <?= $seller->corresp_ac ?><br />

        <?= $seller->getAttributeLabel('bik') ?>:
        <?= $seller->bik ?><br />

        <?= $seller->getAttributeLabel('bank') ?>:
        <?= $seller->bank ?>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <?= $buyer->getAttributeLabel('name') ?>:
        <?= $buyer->name ?><br />

        <?= $buyer->getAttributeLabel('address') ?>:
        <?= $buyer->address ?><br />

        <?= $buyer->getAttributeLabel('inn') ?>:
        <?= $buyer->inn ?><br />

        <?= $buyer->getAttributeLabel('bik') ?>:
        <?= $buyer->bik ?><br />

        <?= $buyer->getAttributeLabel('checking_ac') ?>:
        <?= $buyer->checking_ac ?><br />

        <?= $buyer->getAttributeLabel('corresp_ac') ?>:
        <?= $buyer->corresp_ac ?><br />

        <?= $buyer->getAttributeLabel('bik') ?>:
        <?= $buyer->bik ?><br />

        <?= $buyer->getAttributeLabel('bank') ?>:
        <?= $buyer->bank ?>
    </div>
</div>

<hr>

<h3 class="text-center">Счёт № <?= $model->id ?> от <?= $model->getDate() ?></h3>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center">№</th>
                <th class="text-center"><?= $param->getAttributeLabel('name') ?></th>
                <th class="text-center"><?= $param->getAttributeLabel('units') ?></th>
                <th class="text-center"><?= $model->getAttributeLabel('quantity') ?></th>
                <th class="text-center"><?= $model->getAttributeLabel('price') ?></th>
                <th class="text-center"><?= $model->getAttributeLabel('total') ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">1</td>
                <td><?= $param->name ?></td>
                <td class="text-center"><?= $param->units ?></td>
                <td class="text-center"><?= $model->quantity ?></td>
                <td class="text-center"><?= $model->getPrice() ?></td>
                <td class="text-center"><?= $model->getTotalPrice() ?></td>
            </tr>
            <tr>
                <td colspan="3">Итого:</td>
                <td class="text-center"><?= $model->quantity ?></td>
                <td class="text-center"><?= $model->getPrice() ?></td>
                <td class="text-center"><?= $model->getTotalPrice() ?></td>
            </tr>
            </tbody>
        </table>
        <div>Сумма прописью: <?= $model->getTotalPrice2String() ?>. Без НДС.</div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-4 col-md-offset-2">Индивидуальный предприниматель</div>
    <div class="col-md-3">______________________________</div>
    <div class="col-md-3">(____________________)</div>
</div>