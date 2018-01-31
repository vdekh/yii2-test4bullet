<?php

namespace app\modules\order\repositories;

use app\modules\order\entities\OrderParam;

class OrderParamRepository
{
    /**
     * @param $id
     * @return OrderParam
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        if (!$service = OrderParam::findOne($id)) {
            throw new \InvalidArgumentException('Model not found');
        }
        return $service;
    }

    /**
     * @param OrderParam $service
     */
    public function add(OrderParam $service)
    {
        if (!$service->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $service->insert(false);
    }

    /**
     * @param OrderParam $service
     */
    public function save(OrderParam $service)
    {
        if ($service->getIsNewRecord()) {
            throw new \InvalidArgumentException('Model not exists');
        }
        $service->update(false);
    }
}
