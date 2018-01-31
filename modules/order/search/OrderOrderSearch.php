<?php

namespace app\modules\order\search;

use app\modules\order\entities\OrderOrder;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the ActiveQuery class for [[OrderOrder]].
 *
 * @see OrderOrder
 */
class OrderOrderSearch extends Model
{
    public function search($params)
    {
        $query = OrderOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 2,
            ],
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['id'=>SORT_DESC],
        ]);

        $params = ['OrderOrderSearch' => $params];
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
