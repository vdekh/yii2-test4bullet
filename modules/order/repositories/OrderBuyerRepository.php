<?php

namespace app\modules\order\repositories;

use app\modules\order\entities\OrderBuyer;

class OrderBuyerRepository
{
    /**
     * @param $id
     * @return OrderBuyer
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$buyer = OrderBuyer::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $buyer;
    }

    /**
     * @param OrderBuyer $buyer
     * @return OrderBuyer
     */
    public function add(OrderBuyer $buyer)
    {
        if (!$buyer->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $buyer->insert(false);
        return $buyer;
    }

    /**
     * @param OrderBuyer $buyer
     */
    public function save(OrderBuyer $buyer)
    {
        if ($buyer->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $buyer->update(false);
    }
}
