<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180708191150Add_column_project_title_to_project_table
 */
class M180708191150Add_column_project_title_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%project}}', 'project_title', $this->string(65));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%project}}', 'project_title');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180708191150Add_column_project_title_to_project_table cannot be reverted.\n";

        return false;
    }
    */
}
