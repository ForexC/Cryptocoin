<?php

/* @var $this yii\web\View */
use app\models\DepositForm;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* @var $depositForm DepositForm */
/* @var $deposits ActiveDataProvider */

$this->title = 'Cryptocoin online';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Cryptocoin online</h1>

        <p class="lead">
            Enter your address, invest and get BTC!

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">


                <?php if (Yii::$app->session->hasFlash('result')) { ?>

                    <?= Yii::$app->session->getFlash('result') ?>

                <?php } else { ?>

                    <?php $form = \yii\widgets\ActiveForm::begin(
                        [
                            'options' => [
                                'class' => 'form',
                            ],
                            'fieldConfig' => [
                                'template' => '{input} {error}',
                            ],
                        ]
                    );
                    ?>
                    <?= $form->field($depositForm, 'pay_address')->textInput(
                        ['class' => 'form-control', 'placeholder' => 'Enter address']
                    ) ?>

                    <input type="submit" class="btn btn-lg btn-success" value="Double coins">
                    <?php \yii\widgets\ActiveForm::end(); ?>

                <?php } ?>


            </div>

            <div class="col-lg-4"></div>
        </div>
        </p>

        <p>

        </p>
    </div>

    <div class="body-content">

        <div class="row">

            <div class="col-lg-1">

            </div>

            <div class="col-lg-10">
                <a href="<?= Url::to(['site/index']) ?>">All investments</a> | <a
                    href="<?= Url::to(['site/index', 'type' => 'my']) ?>">My investments</a> | <a
                    href="<?= Url::to(['site/index', 'type' => 'paid']) ?>">Payouts</a> | Current: <?=date("d.m.Y H:i:s",time())?>

                <p>

                    <?php
                    echo \yii\grid\GridView::widget(
                        [
                            'tableOptions' => ['class' => 'table'],
                            'summary' => '',
                            'dataProvider' => $deposits,
                            'showFooter' => false,
                            'columns' => [
                                'date' => [
                                    'label' => 'Date (UTC)',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return date("d.m.Y H:i:s", $data->created_date);
                                    },
                                ],
                                'currency' => [
                                    'label' => 'Currency',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return "BTC";
                                    },
                                ],
                                'address' => [
                                    'label' => 'Address',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return $data->address;
                                    },
                                ],
                                'amount' => [
                                    'label' => 'Deposit amount',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return round($data->amount / 100000000, 5)." BTC";
                                    },
                                ],
                                'expire_date' => [
                                    'label' => 'Withdraw date',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return date("d.m.Y H:i:s", $data->expire_date);
                                    },
                                ],
                                'pay_amount' => [
                                    'label' => 'Pay amount',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return round($data->pay_amount / 100000000, 5)." BTC";
                                    },
                                ],
                            ],
                        ]
                    ); ?>

                    <!--<table class="table">
                        <thead>
                        <tr>
                            <th>Date (UTC)</th>
                            <th>Currency</th>
                            <th>Address</th>
                            <th>Deposit amount</th>
                            <th>Time left</th>
                            <th>Pay amount</th>
                            <th>TXID</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2015-06-15 12:40:03</td>
                            <td>BTC</td>
                            <td>3FPmy2pdCsG5YfWqRfDEhJQc56DCDYiGbB</td>
                            <td>0.23 BTC</td>
                            <td>PENDING</td>
                            <td>0.46 BTC</td>
                            <td>TXID</td>
                        </tr>
                        <tr>
                            <td>2015-06-15 12:40:03</td>
                            <td>BTC</td>
                            <td>3FPmy2pdCsG5YfWqRfDEhJQc56DCDYiGbB</td>
                            <td>0.23 BTC</td>
                            <td>PENDING</td>
                            <td>0.46 BTC</td>
                            <td>TXID</td>
                        </tr>
                        <tr>
                            <td>2015-06-15 12:40:03</td>
                            <td>BTC</td>
                            <td>3FPmy2pdCsG5YfWqRfDEhJQc56DCDYiGbB</td>
                            <td>0.23 BTC</td>
                            <td>PENDING</td>
                            <td>0.46 BTC</td>
                            <td>TXID</td>
                        </tr>
                        <tr>
                            <td>2015-06-15 12:40:03</td>
                            <td>BTC</td>
                            <td>3FPmy2pdCsG5YfWqRfDEhJQc56DCDYiGbB</td>
                            <td>0.23 BTC</td>
                            <td>PENDING</td>
                            <td>0.46 BTC</td>
                            <td>TXID</td>
                        </tr>
                        <tr>
                            <td>2015-06-15 12:40:03</td>
                            <td>BTC</td>
                            <td>3FPmy2pdCsG5YfWqRfDEhJQc56DCDYiGbB</td>
                            <td>0.23 BTC</td>
                            <td>PENDING</td>
                            <td>0.46 BTC</td>
                            <td>TXID</td>
                        </tr>

                    </table>-->


                </p>

            </div>

            <div class="col-lg-1">

            </div>
        </div>

    </div>
</div>
