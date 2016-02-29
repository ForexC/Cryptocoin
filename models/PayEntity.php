<?php

namespace app\models;

/**
 * This is the model class for table "cryptocoin_pays".
 *
 * @property integer $id
 * @property integer $created_date
 * @property integer $user_id
 * @property integer $amount
 * @property string $address
 */
class PayEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cryptocoin_pays';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date','amount','user_id'], 'integer'],
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
            'amount' => 'Paid',
            'user_id' => 'User id',
            'address' => 'Address',
        ];
    }

}
