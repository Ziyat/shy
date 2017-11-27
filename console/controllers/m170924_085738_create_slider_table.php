<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider`.
 */
class m170924_085738_create_slider_table extends Migration
{

   /**
    * @inheritdoc
    */
   public function up()
   {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%slider}}', [
         'id' => $this->primaryKey(),
         'h1' => $this->string(),
         'h2' => $this->string(),
         ], $tableOptions);
   }

   /**
    * @inheritdoc
    */
   public function down()
   {
      $this->dropTable('slider');
   }

}