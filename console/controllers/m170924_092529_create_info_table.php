<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info`.
 */
class m170924_092529_create_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%info}}', [
         'id' => $this->primaryKey(),
         'phone' => $this->string(),
         'address' => $this->string(),
         ], $tableOptions);

      $this->insert('info', [
         'id' => 1,
         'phone' => '+998 91 215 47 27',
         'address' => 'Ma`lumot',
      ]);
   }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info');
    }
}
