<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate_steps`.
 */
class m181220_172342_create_rate_steps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rate_steps}}', [
            'id' => $this->primaryKey(),
            'step' => $this->integer()->notNull()->unique(),
            'description' => $this->string(),
        ]);

        $this->batchInsert('{{%rate_steps}}',['id','step','description'],[
            [1,1,null],
            [2,2,null],
            [3,3,null],
            [4,4,null],
            [5,5,null],
            [6,6,null],
            [7,7,null],
            [8,8,null],
            [9,9,null],
            [10,10,null],
            [11,11,null],
            [12,12,null],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rate_steps}}');
    }
}
