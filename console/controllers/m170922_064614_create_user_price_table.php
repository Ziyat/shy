<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_price`.
 */
class m170922_064614_create_user_price_table extends Migration
{

   /**
    * @inheritdoc
    */
   public function up()
   {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

      $this->createTable('{{%user_price}}', [
         'id' => $this->primaryKey(),
         'user_id' => $this->integer()->notNull(),
         'price_id' => $this->integer()->notNull(),
         'is_closed' => $this->boolean()->notNull(),
         'created_at' => $this->integer()->notNull(),
         'updated_at' => $this->integer()->notNull(),
         ], $tableOptions);

      $this->createIndex('{{%idx-user_price-user_id}}', '{{%user_price}}', 'user_id');
      $this->createIndex('{{%idx-user_price-price_id}}', '{{%user_price}}', 'price_id');

      $this->createIndex('{{%idx-user_price-user_id-price_id}}', '{{%user_price}}', ['user_id', 'price_id'], true);

      $this->addForeignKey('{{%fk-user_price-user_id}}', '{{%user_price}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
      $this->addForeignKey('{{%fk-user_price-price_id-price-id}}', '{{%user_price}}', 'price_id', '{{%price}}', 'id', 'RESTRICT', 'RESTRICT');
   }

   /**
    * @inheritdoc
    */
   public function down()
   {
      $this->dropTable('user_price');
   }

}