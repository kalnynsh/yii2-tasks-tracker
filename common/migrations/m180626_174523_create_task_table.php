<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180626_174523_create_task_table extends Migration
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
            '{{%task}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(124)->notNull(),
                'assignee_id' => $this->integer(),
                'teamlead_id' => $this->integer(),
                'start' => $this->dateTime(),
                'deadline' => $this->dateTime(),
                'end' => $this->dateTime(),
                'status' => $this->tinyInteger()->defaultValue(0),
                'description' => $this->text(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_task__user_assignee', '{{%task}}', 'assignee_id', 'user', 'id'
        );

        $this->createIndex('fk_task__user_assignee_idx', '{{%task}}', 'assignee_id');

        $this->addForeignKey(
            'fk_task__user_teamlead', '{{%task}}', 'teamlead_id', 'user', 'id'
        );

        $this->createIndex('fk_task__user_teamlead_idx', '{{%task}}', 'teamlead_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_task__user_teamlead_idx', '{{%task}}');
        $this->dropForeignKey('fk_task__user_teamlead', '{{%task}}');
        $this->dropIndex('fk_task__user_assignee_idx', '{{%task}}');
        $this->dropForeignKey('fk_task__user_assignee', '{{%task}}');
        $this->dropTable('{{%task}}');
    }
}
