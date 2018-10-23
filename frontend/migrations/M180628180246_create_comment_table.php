<?php

namespace frontend\migrations;

use yii\db\Migration;

/**
 * Class M180628180246_create_comment_table
 */
class M180628180246_create_comment_table extends Migration
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
            '{{%comment}}',
            [
                'id' => $this->primaryKey(),
                'task_id' => $this->integer(),
                'body' => $this->text(),
                'status' => $this->tinyInteger()->defaultValue(10),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_comment__task', '{{%comment}}', 'task_id', 'task', 'id'
        );

        $this->createIndex('fk_comment__task_idx', '{{%comment}}', 'task_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_comment__task_idx', '{{%comment}}');
        $this->dropForeignKey('fk_comment__task', '{{%comment}}');
        $this->dropTable('{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180628180246_create_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
