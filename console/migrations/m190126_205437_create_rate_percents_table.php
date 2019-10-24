<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate_percents`.
 */
class m190126_205437_create_rate_percents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rate_percents}}', [
            'rate_id' => $this->integer()->notNull(),
            'step_id' => $this->integer()->notNull(),
            'value' => $this->float()->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk-rate_percents-rate_id}}',
            '{{%rate_percents}}',
            'rate_id',
            '{{%rates}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-rate_percents-step_id}}',
            '{{%rate_percents}}',
            'step_id',
            '{{%rate_steps}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rate_percents}}');
    }
}
