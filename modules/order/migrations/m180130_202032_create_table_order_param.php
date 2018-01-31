<?php

use yii\db\Migration;

/**
 * Создание таблицы параметров счёта
 *
 * Class m180130_202032_create_table_order_param
 */
class m180130_202032_create_table_order_param extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('order_param', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'units' => $this->string(5)->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('order_param');
    }
}
