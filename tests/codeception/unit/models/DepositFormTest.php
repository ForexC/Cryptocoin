<?php

namespace tests\codeception\unit\models;

use app\models\DepositForm;
use Codeception\Specify;
use yii\codeception\TestCase;

class DepositFormTest extends TestCase
{
    use Specify;

    public function testValidateRequiredFail()
    {
        $model = new DepositForm([
            'pay_address' => '',
        ]);

        $this->specify('deposit form should fails validate in case form is empty', function () use ($model) {
            expect('model should not validate', $model->validate())->false();
        });
    }

    public function testValidateRequiredSuccess()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW',
        ]);

        $this->specify('deposit form should accept validate', function () use ($model) {
            expect('model should validate', $model->validate())->true();
        });
    }

    public function testValidateMinFail()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT2',
        ]);

        $this->specify('deposit form should fails validate in case min chars', function () use ($model) {
            expect('model should not validate', $model->validate())->false();
        });
    }

    public function testValidateMinSuccess()
    {
        $model = new DepositForm([
            'pay_address' => '13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW',
        ]);

        $this->specify('deposit form should accept validate', function () use ($model) {
            expect('model should validate', $model->validate())->true();
        });
    }
}
