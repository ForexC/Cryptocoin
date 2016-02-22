<?php

namespace app\models;

/**
 * This is the model class for table "cryptocoin_deposits".
 *
 * @property integer $id
 * @property integer $created_date
 * @property integer $updated_date
 * @property string $currency
 * @property string $address
 * @property string $pay_address
 * @property integer $amount
 * @property integer $pay_amount
 * @property integer $status
 */
class DepositEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cryptocoin_deposits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date','updated_date','amount','pay_amount','expire_date','status'], 'integer'],
            [['currency','address','pay_address'], 'string', 'max' => 100]
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
            'currency' => 'Currency',
            'address' => 'Address',
            'pay_address' => 'Pay address',
            'amount' => 'Amount',
            'pay_amount' => 'Pay amount',
            'status' => 'Status',
        ];
    }

}
