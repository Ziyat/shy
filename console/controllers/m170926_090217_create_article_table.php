<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170926_090217_create_article_table extends Migration
{

   /**
    * @inheritdoc
    */
   public function up()
   {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%article}}', [
         'id' => $this->primaryKey(),
         'title' => $this->string()->notNull(),
         'text' => 'MEDIUMTEXT',
         'created_at' => $this->integer()->notNull(),
         'updated_at' => $this->integer()->notNull(),
         ], $tableOptions);
   }

   /**
    * @inheritdoc
    */
   public function down()
   {
      $this->dropTable('article');
   }

}