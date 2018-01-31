<?php

namespace app\modules\order\repositories;

use app\modules\order\entities\OrderSeller;

class OrderSellerRepository
{
    /**
     * @param $id
     * @return OrderSeller
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$seller = OrderSeller::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $seller;
    }

    /**
     * @param OrderSeller $seller
     */
    public function add(OrderSeller $seller)
    {
        if (!$seller->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $seller->insert(false);
    }

    /**
     * @param OrderSeller $seller
     */
    public function save(OrderSeller $seller)
    {
        if ($seller->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $seller->update(false);
    }
}
