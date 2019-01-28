<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admintrator`.
 */
class m190128_095953_create_admintrator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'avatar' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(10),
            'last_login_ip' => $this->char(22)->null(),
            'login_count' => $this->integer()->notNull()->defaultValue(0),
            'last_login_at' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull()->comment("创建时间"),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->batchInsert('{{admin_user}}', ['id', 'username', 'auth_key', 'password_hash', 'email', 'avatar', 'status', 'login_count', 'last_login_at', 'created_at', 'updated_at'], [
            [
                1,
                'admin',
                '1TK5QuneTxFZxTyZRK-VZTX_bnPi8f1V',
                '$2y$13$DmhZ20zSUC8mhNnS2jL8oe.A5f7JBQVZvhQ0XuNi1fm4qSS1brz/y',
                'admin@168.com',
                '',
                10,
                0,
                0,
                '1513140415',
                '1513140415'
            ]
        ])
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%admin_user}}');
    }
}
