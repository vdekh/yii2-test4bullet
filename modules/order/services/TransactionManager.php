<?php

namespace app\modules\order\services;

class TransactionManager
{
    public function begin()
    {
        return new Transaction(\Yii::$app->db->beginTransaction());
    }
}
