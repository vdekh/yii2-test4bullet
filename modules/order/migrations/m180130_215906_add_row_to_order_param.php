<?php

use yii\db\Migration;

/**
 * Добавление одного наименования
 *
 * Class m180130_215906_add_row_to_order_param
 */
class m180130_215906_add_row_to_order_param extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert(
            'order_param',
            [
                'id',
                'name',
                'units',
                'created_at',
            ],
            [
                [
                    '1',
                    'Оказание услуг по обслуживанию компьютерной техники',
                    'шт.',
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
        $this->delete('order_param', ['in', 'id', [1]]);
    }
}
