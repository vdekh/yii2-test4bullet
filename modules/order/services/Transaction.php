<?php

namespace app\modules\order\services;

class Transaction
{
    private $transaction;

    public function __construct(\yii\db\Transaction $transaction){

        $this->transaction = $transaction;
    }

    public function commit()
    {
        $this->transaction->commit();
    }

    public function rollback()
    {
        $this->transaction->rollBack();
    }
}
