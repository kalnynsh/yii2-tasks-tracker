<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180708183205Add_column_project_id_to_task
 */
class M180708183205Add_column_project_id_to_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'project_id', $this->integer()->defaultValue(1));

        $this->addForeignKey(
            'fk_task__project',
            '{{%task}}',
            'project_id',
            'project',
            'id'
        );

        $this->createIndex(
            'fk_task__project_idx',
            '{{%task}}',
            'project_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_task__project_idx', '{{%task}}');
        $this->dropForeignKey('fk_task__project', '{{%task}}');
        $this->dropColumn('{{%task}}', 'project_id');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180708183205Add_column_project_id_to_task cannot be reverted.\n";

        return false;
    }
    */
}
