<?php

use yii\db\Migration;

/**
 * Добавление одного покупателя
 *
 * Class m180130_214306_add_row_to_order_seller
 */
class m180130_214306_add_row_to_order_seller extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert(
            'order_seller',
            [
                'id',
                'name',
                'address',
                'inn',
                'checking_ac',
                'corresp_ac',
                'bik',
                'bank',
                'created_at',
            ],
            [
                [
                    '1',
                    'Индивидуальный предприниматель Иванов Сергей Петрович',
                    'Санкт-Петербург, ул. Садовая, д. 2, корп. 2, оф. 22',
                    '1234567890',
                    '12345678901234567890',
                    '11223344556677889900',
                    '123456789',
                    'ОАО БАНК "МОЙ БАНК", Г. САНКТ-ПЕТЕРБУРГ',
                    time(),
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('order_seller', ['in', 'id', [1]]);
    }
}
