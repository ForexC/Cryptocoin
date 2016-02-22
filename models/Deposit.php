<?php

namespace app\models;

use app\components\PaymentInterface;

class Deposit
{
    const NOT_PAID = 0;

    const ACTIVE = 1;

    const FINISHED = 2;

    public $address;

    public $currency;

    public $pay_address;

    public $period;

    private $entity;

    private $payment;

    function __construct($entity,PaymentInterface $payment)
    {
        $this->entity = $entity;
        $this->payment = $payment;
    }

    public function take(DepositForm $form)
    {
        $this->pay_address = $form->pay_address;
        $this->currency = 'btc';
    }

    public function create()
    {
        $this->address = $this->payment->generateAddress();
        $this->entity->pay_address = $this->pay_address;
        $this->entity->address = $this->address;
        $this->entity->currency = $this->currency;
        $this->entity->created_date = time();
        $this->entity->status = self::NOT_PAID;

        return $this->entity->save();
    }


}