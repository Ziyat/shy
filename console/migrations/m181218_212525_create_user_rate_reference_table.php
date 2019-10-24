<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_rate_reference`.
 */
class m181218_212525_create_user_rate_reference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_rate_reference}}', [
            'user_id' => $this->integer()->notNull()->unique(),
            'rate_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-user_rate_reference}}',
            '{{%user_rate_reference}}',
            ['user_id', 'rate_id'],
            ['user_id', 'rate_id']
        );

        $this->addForeignKey(
            '{{fk-user_rate_reference-user_id}}',
            '{{%user_rate_reference}}',
            'user_id',
            '{{%users}}',
            'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey(
            '{{fk-user_rate_reference-rate_id}}',
            '{{%user_rate_reference}}',
            'rate_id',
            '{{%rates}}',
            'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_rate_reference}}');
    }
}
