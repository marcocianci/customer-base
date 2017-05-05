<?php

//use yii\db\Migration;

class m130524_444333_natural_person extends \common\components\migrations\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%natural_person}}', [
            'id' => $this->primaryKey(),
            'cpf' => $this->string(120)->notNull(),
            'born_date' => $this->date()->notNull(),
            'rg' => $this->string(20)->notNull()->unique(),
            'user_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-natural_person-user',
            'natural_person',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%natural_person}}');
    }
}