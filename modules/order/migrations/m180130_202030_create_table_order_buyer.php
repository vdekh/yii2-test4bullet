<?php

use yii\db\Migration;

/**
 * Создание таблицы покупателей
 *
 * Class m180130_202030_create_table_order_buyer
 */
class m180130_202030_create_table_order_buyer extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('order_buyer', [
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
        $this->dropTable('order_buyer');
    }
}
