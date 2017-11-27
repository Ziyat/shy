<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m171124_025510_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'lang_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'show_on_menu' => $this->boolean()->notNull(),
            'position' => $this->integer()->notNull(),
            'action' => $this->string(),
            'alias' => $this->string(),
            'text' => 'MEDIUMTEXT',
            'link' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
