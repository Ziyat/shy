<?php

use yii\db\Migration;


class m190924_084817_add_columns_to_profiles_table extends Migration
{
    private $tableName = '{{%profiles}}';

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'phone_first', $this->string(13)->notNull());
        $this->addColumn($this->tableName, 'phone_second', $this->string(13)->null());
        $this->addColumn($this->tableName, 'address_first', $this->string()->notNull());
        $this->addColumn($this->tableName, 'address_second', $this->string()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'phone_first');
        $this->dropColumn($this->tableName, 'phone_second');
        $this->dropColumn($this->tableName, 'address_first');
        $this->dropColumn($this->tableName, 'address_second');
    }
}
