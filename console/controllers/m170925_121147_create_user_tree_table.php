<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_tree`.
 */
class m170925_121147_create_user_tree_table extends Migration
{

   /**
    * @inheritdoc
    */
   public function up()
   {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%user_tree}}', [
         'id' => $this->primaryKey(),
         'user_id' => $this->integer()->notNull(),
         'user_depth' => $this->integer()->notNull(),
         'parent_id' => $this->integer()->notNull(),
         'parent_depth' => $this->integer()->notNull(),
         'created_at' => $this->integer()->notNull(),
         'updated_at' => $this->integer()->notNull(),
         ], $tableOptions);

      $this->createIndex('{{%idx-user_tree-user_id}}', '{{%user_tree}}', 'user_id');
      $this->createIndex('{{%idx-user_tree-parent_id}}', '{{%user_tree}}', 'parent_id');

      $this->createIndex('{{%idx-user_tree-user_id-parent_id}}', '{{%user_tree}}', ['user_id', 'parent_id'], true);

      $this->addForeignKey('{{%fk-user_tree-user_id-user-id}}', '{{%user_tree}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
      $this->addForeignKey('{{%fk-user_tree-parent_id-user-id}}', '{{%user_tree}}', 'parent_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');

      $this->insert('user_tree', [
         'user_id' => 1,
         'parent_id' => 1,
         'user_depth' => 0,
         'parent_depth' => 0,
         'created_at' => time(),
         'updated_at' => time(),
      ]);
   }

   /**
    * @inheritdoc
    */
   public function down()
   {
      $this->dropTable('user_tree');
   }

}