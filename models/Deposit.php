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

    public $amount;

    public $payAmount;

    public $userId;

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
        $this->entity->user_id = $this->userId;
        $this->entity->status = self::NOT_PAID;

        return $this->entity->save();
    }

    public function calculatePayAmount($amount)
    {
        $rand = rand(10,20) / 10;
        $this->amount = $amount * 100000000;
        $this->payAmount = $this->amount * $rand;
    }

    public function start($expirePeriod)
    {
        $this->period = $expirePeriod;
        $this->entity->amount  = $this->amount;
        $this->entity->pay_amount  = $this->payAmount;
        $this->entity->expire_date = time() + $this->period;
        $this->entity->status = self::ACTIVE;
        return $this->entity->save();
    }

    public function pay()
    {
        return $this->payment->send(['wallet'=>$this->pay_address,'amount'=>$this->payAmount]);
    }

    public function finish()
    {
        $this->entity->updated_date = time();
        $this->entity->status = self::FINISHED;
        return $this->entity->save();
    }


}