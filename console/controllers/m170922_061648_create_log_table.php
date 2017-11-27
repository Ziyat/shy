<?php

use yii\db\Migration;

/**
 * Handles the creation of table `log`.
 */
class m170922_061648_create_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

      $this->createTable('{{%log}}', [
         'id' => $this->primaryKey(),
         'type' => $this->integer()->notNull(),
         'info1' => $this->integer()->notNull(),
         'info2' => $this->integer()->notNull(),
         'created_at' => $this->integer()->notNull(),
         'updated_at' => $this->integer()->notNull(),
         ], $tableOptions);
   }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('log');
    }
}
