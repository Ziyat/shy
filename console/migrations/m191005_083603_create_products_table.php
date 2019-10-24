<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m191005_083603_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'desc' => $this->string()->null(),
            'img' => $this->string()->null(),
            'in_price' => $this->float()->notNull(),
            'out_price' => $this->float()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk-products-category_id}}',
            '{{%products}}',
            'category_id',
            '{{%product_categories}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
