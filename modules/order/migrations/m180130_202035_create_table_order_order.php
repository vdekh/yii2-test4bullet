<?php

use yii\db\Migration;

/**
 * Создание таблицы счетов
 *
 * Class m180130_202035_create_table_order_order
 */
class m180130_202035_create_table_order_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('order_order', [
            'id' => $this->primaryKey(),
            'seller_id' => $this->integer()->notNull(),
            'buyer_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'units' => $this->string(4)->notNull(),
            'quantity' => $this->smallInteger()->notNull(),
            'price' => $this->float()->notNull(),
            'total' => $this->float()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('order_order');
    }
}
