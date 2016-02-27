<?php

namespace app\models;

use Yii;
use yii\base\Model;


class DepositForm extends Model
{
    public $pay_address;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['pay_address'], 'required'],
            [['pay_address'], 'string', 'min' => 30, 'max' => 100],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'pay_address' => 'Address to pay',
        ];
    }

}
