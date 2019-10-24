<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->string()->notNull()->defaultValue('user'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('lft', '{{%users}}', ['lft', 'rgt']);
        $this->createIndex('rgt', '{{%users}}', ['rgt']);

        $this->insert('{{%users}}', [
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'username' => 'admin',
            'password_hash' => \Yii::$app->security->generatePasswordHash('w5CacB7cxYk@'),
            'status' => 10,
            'role' => 'administrator',
            'created_at' => time(),
            'updated_at' => time(),
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
