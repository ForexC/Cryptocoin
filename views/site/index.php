<?php

/* @var $this yii\web\View */
use app\models\DepositForm;

/* @var $depositForm DepositForm */

$this->title = 'Cryptocoin online';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Cryptocoin online</h1>

        <p class="lead">
            Enter your address, invest and get BTC, LTC, DOGE !
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
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
                <a href="#">All investments(1092)</a> | <a href="#">My investments(5)</a> | <a href="#">Payouts(12)</a>

                <p>
                <table class="table">
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

                </table>

                <?php
                /*                echo \yii\grid\GridView::widget([
                                    'tableOptions'=>['cellpadding'=>'20','cellspacing'=>'20'],
                                    'summary'=>'',
                                    'dataProvider' => $orders,
                                    'showFooter'=>false,
                                    'columns' => [
                                        'date'=>[
                                            'label'=>'Дата',
                                            'format' => 'raw',
                                            'value'=>function ($data) {
                                                return date("d.m.Y H:i:s", strtotime($data->date));
                                            },
                                        ],
                                        'amountin'=>[
                                            'label'=>'Отдаем',
                                            'format' => 'raw',
                                            'value'=>function ($data) {
                                                return $data->amountin." ".$data->curin;
                                            },
                                        ],
                                        'amountout'=>[
                                            'label'=>'Получаем',
                                            'format' => 'raw',
                                            'value'=>function ($data) {
                                                return $data->amountout." ".$data->curout;
                                            },
                                        ],
                                        'walletout',
                                        'status'=>[
                                            'label'=>'Статус',
                                            'headerOptions' =>[],
                                            'contentOptions' =>[],
                                            'value'=>function ($data) {
                                                if($data->status == \app\modules\exchange\models\Order::STATUS_NOTPAID) return 'Не оплачено вами';
                                                if($data->status == \app\modules\exchange\models\Order::STATUS_SERVICE_CANCELLED) return 'Отменено';
                                                if($data->status == \app\modules\exchange\models\Order::STATUS_SERVICE_FINISHED) return 'Завершено';
                                                if($data->status == \app\modules\exchange\models\Order::STATUS_SERVICE_PAID) return 'В обработке';
                                                if($data->status == \app\modules\exchange\models\Order::STATUS_USER_PAID) return 'Оплачено вами';
                                            }
                                        ],
                                        'status1'=>[
                                            'label'=>'',
                                            'format'=>'html',
                                            'headerOptions' =>[],
                                            'contentOptions' =>[],
                                            'value'=>function ($data) {
                                                return "<a href='".\yii\helpers\Url::to(['/exchange/default/status','hash'=>$data->hash])."'>Статус обмена</a>";
                                            }
                                        ]
                                    ],
                                ]); */ ?>

                </p>

            </div>

            <div class="col-lg-1">

            </div>
        </div>

    </div>
</div>
