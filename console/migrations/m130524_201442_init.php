<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%student}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'status'               => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at'           => $this->integer()->unsigned()->notNull(),
            'updated_at'           => $this->integer()->unsigned()->notNull(),
            'student_id'           => $this->string(16)->notNull()->defaultValue('')->comment('学号'),
            'sex'                  => $this->string('4')->defaultValue('male')->comment('性别，男：male,女：female'),
            'depart'               => $this->string('16')->defaultValue('')->comment('系别'),
            'class'                => $this->string(60)->defaultValue('')->comment('班别'),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
