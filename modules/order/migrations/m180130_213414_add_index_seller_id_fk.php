<?php

use yii\db\Migration;

/**
 * Добавление внешнего ключа таблицы продавца для таблицы заказа
 *
 * Class m180130_213414_add_index_seller_id_fk
 */
class m180130_213414_add_index_seller_id_fk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addForeignKey('order_order_seller_id_fk', 'order_order', 'seller_id', 'order_seller', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('order_order_seller_id_fk', 'order_order');
    }
}
