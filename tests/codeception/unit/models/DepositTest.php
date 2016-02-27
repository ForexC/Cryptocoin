<?php

namespace tests\codeception\unit\models;

use app\components\Bitcoin;
use app\models\Deposit;
use app\models\DepositEntity;
use app\models\DepositForm;
use Codeception\Specify;
use yii\codeception\TestCase;
use Yii;

class DepositTest extends TestCase
{
    private $deposit;

    protected function setUp()
    {
        parent::setUp();

        $depositEntity = new DepositEntity();
        $bitcoin = new Bitcoin(
            Yii::$app->params['BTC_IPN_PASSWORD'],
            Yii::$app->params['BTC_GUID'],
            Yii::$app->params['BTC_PASSWORD'],
            Yii::$app->params['BTC_SECOND_PASSWORD']
        );

        $this->deposit = new Deposit($depositEntity, $bitcoin);
    }

    public function testTake()
    {
        $form = new DepositForm(
            [
                'pay_address' => '13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW',
            ]
        );

        $this->deposit->take($form);

        $this->assertNotEmpty($this->deposit->pay_address);
    }

    public function testCreate()
    {
        $bitcoinMock = $this->getMock('app\components\Bitcoin', array('generateAddress'),['','','','']);
        $bitcoinMock->expects($this->once())->method('generateAddress')->will(
            $this->returnValue('12Q2XBT26cZgPzs3HmhT2ynyQPmvoj1234')
        );

        $depositEntityMock = $this->getMock('app\models\DepositEntity', array('save'));
        $depositEntityMock->expects($this->once())->method('save')->will($this->returnValue(true));

        $this->deposit = new Deposit($depositEntityMock, $bitcoinMock);
        $this->deposit->pay_address = "13Q2XBT26cZgPzs3HmhT2ynyQPmvojK7dW";
        $this->deposit->currency = "btc";
        $this->assertTrue($this->deposit->create());
    }

    public function testCalculatePayAmount()
    {
        $bitcoin = new Bitcoin(
            Yii::$app->params['BTC_IPN_PASSWORD'],
            Yii::$app->params['BTC_GUID'],
            Yii::$app->params['BTC_PASSWORD'],
            Yii::$app->params['BTC_SECOND_PASSWORD']
        );
        $this->deposit = new Deposit(new DepositEntity(), $bitcoin);
        $this->deposit->calculatePayAmount(1);
        $this->assertGreaterThan(1, $this->deposit->payAmount);
        $this->assertNotEquals(1, $this->deposit->payAmount);
    }

    public function testStart()
    {
        $bitcoin = new Bitcoin(
            Yii::$app->params['BTC_IPN_PASSWORD'],
            Yii::$app->params['BTC_GUID'],
            Yii::$app->params['BTC_PASSWORD'],
            Yii::$app->params['BTC_SECOND_PASSWORD']
        );

        $depositEntityMock = $this->getMock('app\models\DepositEntity', array('save'));
        $depositEntityMock->expects($this->once())->method('save')->will($this->returnValue(true));

        $this->deposit = new Deposit($depositEntityMock, $bitcoin);
        $this->deposit->amount = 1;
        $this->deposit->payAmount = 2;
        $expirePeriod = 100;
        $this->assertTrue($this->deposit->start($expirePeriod));
        $this->assertEquals(time() + 100, $this->deposit->period + time());
    }

    public function testPay()
    {
        $bitcoinMock = $this->getMock('app\components\Bitcoin', array('send'),['','','','']);
        $bitcoinMock->expects($this->once())->method('send')->will(
            $this->returnValue('')
        );

        $this->deposit = new Deposit(new DepositEntity(), $bitcoinMock);
        $this->deposit->pay_address = "28271jjnsjktest";
        $this->deposit->payAmount = 1;
        $this->assertEquals('', $this->deposit->pay());
    }

    public function testFinish()
    {
        $bitcoin = new Bitcoin(
            Yii::$app->params['BTC_IPN_PASSWORD'],
            Yii::$app->params['BTC_GUID'],
            Yii::$app->params['BTC_PASSWORD'],
            Yii::$app->params['BTC_SECOND_PASSWORD']
        );

        $this->deposit = new Deposit(new DepositEntity(), $bitcoin);
        $this->assertTrue($this->deposit->finish());
    }
}
