<?php

use common\models\User;
use yii\db\Expression;

class m130524_201442_user extends \common\components\migrations\Migration
{

    // Use safeUp/safeDown to run migration code within a transaction

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'role' => $this->smallInteger()->notNull()->defaultValue(10), // 10 user , 20 admin
            'status' => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert(
            '{{%user}}',
            [
                'name',
                'username',
                'password_hash',
                'auth_key',
                'email',
                'role',
                'status',
                'created_at',
                'updated_at'
            ],
            [
                [
                    'Aluno',
                    'aluno',
                    \Yii::$app->security->generatePasswordHash('123456'),
                    \Yii::$app->security->generateRandomString(),
                    'aluno@cianci.com.br',
                    User::ROLE_ADMIN,
                    User::STATUS_ACTIVE,
                    (new DateTime())->getTimestamp(),
                    (new DateTime())->getTimestamp()
                ],
                [
                    'Marco',
                    'marco',
                    \Yii::$app->security->generatePasswordHash('123456'),
                    \Yii::$app->security->generateRandomString(),
                    'marco@cianci.com.br',
                    User::ROLE_ADMIN,
                    User::STATUS_ACTIVE,
                    (new DateTime())->getTimestamp(),
                    (new DateTime())->getTimestamp()
                ],


            ]
        );


    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
