<?php

use yii\db\Migration;

/**
 * Добавление внешнего ключа таблицы параметров счёта для таблицы заказа
 *
 * Class m180130_213814_add_index_param_id_fk
 */
class m180130_213814_add_index_param_id_fk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addForeignKey('order_order_param_id_fk', 'order_order', 'service_id', 'order_param', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('order_order_param_id_fk', 'order_order');
    }
}
