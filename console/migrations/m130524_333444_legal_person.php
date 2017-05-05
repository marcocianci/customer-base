<?php

//use yii\db\Migration;

class m130524_333444_legal_person extends \common\components\migrations\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%legal_person}}', [
            'id' => $this->primaryKey(),
            'social_name' => $this->string(120)->notNull(),
            'state_registration' => $this->string(45)->notNull(),
            'cnpj' => $this->string(20)->notNull()->unique(),
            'user_id' => $this->integer()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-legal_person-user',
            'legal_person',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%legal_person}}');
    }
}
