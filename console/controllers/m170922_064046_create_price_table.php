<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m170922_064046_create_price_table extends Migration
{

   /**
    * @inheritdoc
    */
   public function up()
   {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%price}}', [
         'id' => $this->primaryKey(),
         'title' => $this->string()->notNull(),
         'user_count' => $this->integer()->notNull(),
         'day_count' => $this->integer()->notNull(),
         'message' => $this->string()->notNull(),
         'created_at' => $this->integer()->notNull(),
         'updated_at' => $this->integer()->notNull(),
         'update_history' => 'MEDIUMTEXT',
         ], $tableOptions);
   }

   /**
    * @inheritdoc
    */
   public function down()
   {
      $this->dropTable('price');
   }

}