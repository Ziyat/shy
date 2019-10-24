<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_photos`.
 */
class m181206_192433_create_user_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user_photos}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%idx-user_photos-user_id}}', '{{%user_photos}}', 'user_id');
        $this->addForeignKey('{{%fk-user_photos-user_id}}', '{{%user_photos}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_photos}}');
    }
}
