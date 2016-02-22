<?php

namespace app\models;

class Deposit
{
    public $address;

    public $currency;

    public $pay_address;

    private $entity;

    function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function take(DepositForm $form)
    {
        $this->pay_address = $form->pay_address;
    }

}