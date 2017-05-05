<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "natural_person".
 *
 * @property integer $id
 * @property string $cpf
 * @property string $born_date
 * @property string $rg
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class NaturalPerson extends ActiveRecordModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'natural_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['born_date', 'created_at', 'updated_at', 'born_date'], 'safe'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['cpf'], 'string', 'max' => 120],
            [['rg'], 'string', 'max' => 20],
            [['rg'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cpf' => 'Cpf',
            'born_date' => 'Born Date',
            'rg' => 'Rg',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
