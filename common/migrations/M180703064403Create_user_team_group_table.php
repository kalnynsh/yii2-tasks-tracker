<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180703064403Create_user_team_group_table
 */
class M180703064403Create_user_team_group_table extends Migration
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
            '{{%user_team_group}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(),
                'group_id' => $this->integer(),
                'team_id' => $this->integer(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_user__user_team_group',
            '{{%user_team_group}}',
            'user_id',
            'user',
            'id'
        );

        $this->createIndex(
            'fk_user__user_team_group_idx',
            '{{%user_team_group}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk_group__user_team_group',
            '{{%user_team_group}}',
            'group_id',
            'group',
            'id'
        );

        $this->createIndex(
            'fk_group__user_team_group_idx',
            '{{%user_team_group}}',
            'group_id'
        );

        $this->addForeignKey(
            'fk_team__user_team_group',
            '{{%user_team_group}}',
            'team_id',
            'team',
            'id'
        );

        $this->createIndex(
            'fk_team__user_team_group_idx',
            '{{%user_team_group}}',
            'team_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_team__user_team_group_idx', '{{%user_team_group}}');
        $this->dropForeignKey('fk_team__user_team_group', '{{%user_team_group}}');

        $this->dropIndex('fk_group__user_team_group_idx', '{{%user_team_group}}');
        $this->dropForeignKey('fk_group__user_team_group', '{{%user_team_group}}');

        $this->dropIndex('fk_user__user_team_group_idx', '{{%user_team_group}}');
        $this->dropForeignKey('fk_user__user_team_group', '{{%user_team_group}}');

        $this->dropTable('{{%user_team_group}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180703064403Create_user_team_group_table cannot be reverted.\n";

        return false;
    }
    */
}
