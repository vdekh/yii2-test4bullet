<?php

namespace app\modules\order\repositories;

use app\modules\order\entities\OrderOrder;

class OrderOrderRepository
{
    /**
     * @param $id
     * @return OrderOrder
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$order = OrderOrder::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $order;
    }

    /**
     * @param OrderOrder $order
     * @return OrderOrder
     */
    public function add(OrderOrder $order)
    {
        if (!$order->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $order->insert(false);
        return $order;
    }

    /**
     * @param OrderOrder $order
     */
    public function save(OrderOrder $order)
    {
        if ($order->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $order->update(false);
    }
}
