<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180703064324Create_team_table
 */
class M180703064324Create_team_table extends Migration
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
            '{{%team}}',
            [
                'id' => $this->primaryKey(),
                'team_name' => $this->string(50),
                'description' => $this->string(128),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M180703064324Create_team_table cannot be reverted.\n";

        return false;
    }
    */
}
