<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_categories}}`.
 */
class m191005_083519_create_product_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'desc' => $this->string()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_categories}}');
    }
}
