<?php

use yii\db\Migration;

class m130524_444333_natural_person extends Migration
{
    public function up()
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
            'userId' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%people}}');
    }
}
