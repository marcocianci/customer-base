<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "legal_person".
 *
 * @property integer $id
 * @property string $social_name
 * @property string $state_registration
 * @property string $cnpj
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class LegalPerson extends ActiveRecordModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'legal_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_name', 'user_id', ], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['social_name'], 'string', 'max' => 120],
            [['state_registration'], 'string', 'max' => 45],
            [['cnpj'], 'string', 'max' => 20],
            [['cnpj'], 'unique'],
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
            'social_name' => 'Social Name',
            'state_registration' => 'State Registration',
            'cnpj' => 'Cnpj',
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
