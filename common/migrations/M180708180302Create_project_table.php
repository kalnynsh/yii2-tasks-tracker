<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180708180302Create_project_table
 */
class M180708180302Create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions
            = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(
            '{{%project}}',
            [
                'id' => $this->primaryKey(),
                'teamlead_id' => $this->integer(),
                'status_id' => $this->integer(),
                'description' => $this->text(),
                'start' => $this->dateTime(),
                'deadline' => $this->dateTime(),
                'end' => $this->dateTime(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_project__user',
            '{{%project}}',
            'teamlead_id',
            'user',
            'id'
        );

        $this->createIndex(
            'fk_project__user_idx',
            '{{%project}}',
            'teamlead_id'
        );

        $this->addForeignKey(
            'fk_project__status',
            '{{%project}}',
            'status_id',
            'status',
            'id'
        );

        $this->createIndex(
            'fk_project__status_idx',
            '{{%project}}',
            'status_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_project__status_idx', '{{%project}}');
        $this->dropForeignKey('fk_project__status', '{{%project}}');
        $this->dropIndex('fk_project__user_idx', '{{%project}}');
        $this->dropForeignKey('fk_project__user', '{{%project}}');
        $this->dropTable('{{%project}}');

        return true;
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "M180708180302Create_project_table cannot be reverted.\n";

return false;
}
 */
}
