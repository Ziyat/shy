<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profiles`.
 */
class m181206_185649_create_profiles_table extends Migration
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
        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'surname' => $this->string()->notNull(),
            'given_name' => $this->string()->notNull(),
            'father_name' => $this->string()->notNull(),
            'nationality' => $this->string(),
            'date_of_birth' => $this->integer()->notNull(),
            'date_of_expiry' => $this->integer(),
            'date_of_issue' => $this->integer(),
            'place_of_birth' => $this->string(),
            'passport_number' => $this->string(15),
            'sex' => $this->integer(2),
        ], $tableOptions);
        $this->createIndex('{{%idx-profiles}}', '{{%profiles}}', ['user_id', 'surname', 'given_name', 'father_name', 'date_of_birth'],['user_id', 'surname', 'given_name', 'father_name', 'date_of_birth']);
        $this->addForeignKey('{{%fk-profiles-user_id}}', '{{%profiles}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

        $this->insert('{{%profiles}}', [
            'id' => 1,
            'user_id' => 1,
            'surname' => 'Юсупова',
            'given_name' => 'Фатам',
            'father_name' => 'Касимовна',
            'date_of_birth' => strtotime('1991-02-24'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
