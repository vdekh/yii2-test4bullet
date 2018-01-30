<?php

use yii\db\Migration;

/**
 * Создание таблицы продавцов
 *
 * Class m180130_202025_create_table_order_seller
 */
class m180130_202025_create_table_order_seller extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('order_seller', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
            'inn' => $this->integer()->notNull(),
            'checking_ac' => $this->bigInteger()->notNull(),
            'corresp_ac' => $this->bigInteger()->notNull(),
            'bik' => $this->integer()->notNull(),
            'bank' => $this->string(255)->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('order_seller');
    }
}
