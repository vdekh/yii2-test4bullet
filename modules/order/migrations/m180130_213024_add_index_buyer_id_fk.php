<?php

use yii\db\Migration;

/**
 * Добавление внешнего ключа таблицы покупателя для таблицы заказа
 *
 * Class m180130_213024_add_index_buyer_id_fk
 */
class m180130_213024_add_index_buyer_id_fk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addForeignKey('order_order_buyer_id_fk', 'order_order', 'buyer_id', 'order_buyer', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('order_order_buyer_id_fk', 'order_order');
    }
}
