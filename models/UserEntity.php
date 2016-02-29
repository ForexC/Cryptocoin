<?php

namespace app\models;

/**
 * This is the model class for table "cryptocoin_users".
 *
 * @property integer $id
 * @property integer $created_date
 * @property integer $updated_date
 * @property integer $user_id
 * @property string $address
 */
class UserEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cryptocoin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date','updated_date','user_id'], 'integer'],
            [['address'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'created_date' => 'Created date',
            'updated_date' => 'Updated date',
            'user_id' => 'User id',
            'address' => 'Address',
        ];
    }

}
