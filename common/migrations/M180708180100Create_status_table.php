<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180708182450Create_status_table
 */
class M180708180100Create_status_table extends Migration
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

        $this->createTable(
            '{{%status}}',
            [
                'id' => $this->primaryKey(),
                'status_name' => $this->string(50)->notNull(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180708182450Create_status_table cannot be reverted.\n";

        return false;
    }
    */
}
