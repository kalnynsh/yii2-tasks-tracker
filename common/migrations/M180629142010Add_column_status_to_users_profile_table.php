<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180629142010Add_column_status_to_users_profile_table

 */
class M180629142010Add_column_status_to_users_profile_table
 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users_profile}}', 'status', $this->tinyInteger()->defaultValue(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users_profile}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180629142010Add_column_status_to_users_profile_table
 cannot be reverted.\n";

        return false;
    }
    */
}
