<?php

namespace common\migrations;

use yii\db\Migration;

/**
 * Class M180629112806Create_user_profile_table
 */
class M180629112806_create_users_profile_table extends Migration
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
            '{{%users_profile}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(),
                'first_name' => $this->string(124),
                'last_name' => $this->string(124),
                'specialization' => $this->string(124),
                'sex' => $this->tinyInteger()->defaultValue(1),
                'birthday' => $this->date(),
                'phone' => $this->string(50),
                'image' => $this->string(255),
                'country' => $this->string(64)->defaultValue('Russia'),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_user__users_profile',
            '{{%users_profile}}',
            'user_id',
            'user',
            'id'
        );

        $this->createIndex(
            'fk_user__users_profile_idx',
            '{{%users_profile}}',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fk_user__users_profile_idx', '{{%users_profile}}');
        $this->dropForeignKey('fk_user__users_profile', '{{%users_profile}}');
        $this->dropTable('{{%users_profile}}');
    }

    /*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
echo "M180629112806Create_user_profile_table cannot be reverted.\n";

return false;
}
 */
}
