<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AffiliateForm extends Model
{
    public $address;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'min' => 30, 'max' => 100],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'address' => 'Payout address',
        ];
    }

}
