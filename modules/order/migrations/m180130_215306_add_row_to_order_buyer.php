<?php

use yii\db\Migration;

/**
 * Добавление одного продавца
 *
 * Class m180130_215306_add_row_to_order_buyer
 */
class m180130_215306_add_row_to_order_buyer extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert(
            'order_buyer',
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
        $this->delete('order_buyer', ['in', 'id', [1]]);
    }
}
