<?php

namespace app\models;

use app\components\PaymentInterface;

class Deposit
{
    /**
     * Deposit was not paid by user
     */
    const NOT_PAID = 0;
    /**
     * Deposit was paid and pending
     */
    const ACTIVE = 1;
    /**
     * Deposit was closed and user get back
     */
    const FINISHED = 2;
    /**
     * Address generated to pay by user
     */
    public $address;
    /**
     * Deposits currency
     */
    public $currency;
    /**
     * User address to return funds
     */
    public $payAddress;
    /**
     * Amount user deposited, in Satoshi (1 BTC = 100 000 000 )
     */
    public $amount;
    /**
     * Amount user returned funds, in Satoshi (1 BTC = 100 000 000 )
     */
    public $payAmount;
    /**
     * User id number of deposit record
     */
    public $userId;
    /**
     * Expire date of deposit
     */
    public $expireDate;

    /**
     * Active record entity model
     */
    private $entity;
    /**
     * Instance of PaymentInterface of payment class
     */
    private $payment;

    function __construct($entity, PaymentInterface $payment)
    {
        $this->entity = $entity;
        $this->payment = $payment;
    }

    public function take(DepositForm $form)
    {
        $this->payAddress = $form->pay_address;
        $this->currency = 'btc';
    }

    public function create()
    {
        $this->address = $this->payment->generateAddress();
        $this->entity->pay_address = $this->payAddress;
        $this->entity->address = $this->address;
        $this->entity->currency = $this->currency;
        $this->entity->created_date = time();
        $this->entity->user_id = $this->userId;
        $this->entity->status = self::NOT_PAID;

        return $this->entity->save();
    }

    public function calculatePayAmount($amount)
    {
        $rand = rand(10, 20) / 10;
        $this->amount = $amount * 100000000;
        $this->payAmount = $this->amount * $rand;
    }

    public function start($expirePeriod)
    {
        $this->expireDate = time() + $expirePeriod;

        $this->entity->amount = $this->amount;
        $this->entity->pay_amount = $this->payAmount;
        $this->entity->expire_date = $this->expireDate;
        $this->entity->status = self::ACTIVE;

        return $this->entity->save();
    }

    public function pay()
    {
        return $this->payment->send(['wallet' => $this->payAddress, 'amount' => $this->payAmount]);
    }

    public function finish()
    {
        $this->entity->updated_date = time();
        $this->entity->status = self::FINISHED;

        return $this->entity->save();
    }


}