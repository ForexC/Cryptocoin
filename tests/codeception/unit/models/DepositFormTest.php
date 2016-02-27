<?php

namespace tests\codeception\unit\models;

use app\models\DepositForm;
use yii\codeception\TestCase;

class DepositFormTest extends TestCase
{
    public function testValidateRequiredFail()
    {
        $model = new DepositForm([
            'pay_address' => '',
        ]);

        $this->assertFalse($model->validate());
    }

    public function testValidateRequiredSuccess()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW',
        ]);

        $this->assertTrue($model->validate());
    }

    public function testValidateMinFail()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT2',
        ]);

        $this->assertFalse($model->validate());
    }

    public function testValidateMinSuccess()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW',
        ]);

        $this->assertTrue($model->validate());
    }
}
