<?php

use app\models\Deposit;
use app\models\DepositSearch;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel DepositSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deposits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-news-index">

    <h1><?= Html::encode($this->title) ?> [Now date: <?=date("d.m.y H:s",time())?>]</h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'user_id',
            'created_date'=>[
                'attribute' => 'created_date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return date("d.m  H:i",$data->created_date);
                },
            ],
            'updated_date'=>[
                'attribute' => 'updated_date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return date("d.m  H:i",$data->updated_date);
                },
            ],
            'currency',
            'address',
            'pay_address',
            'amount'=>[
                'attribute' => 'amount',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->amount / 100000000;
                },
            ],
            'pay_amount'=>[
                'attribute' => 'amount',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->pay_amount / 100000000;
                },
            ],
            'expire_date'=>[
                'attribute' => 'expire_date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return date("d.m  H:i",$data->expire_date);
                },
            ],
            'status'=>[
                'attribute' => 'status',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == Deposit::NOT_PAID) return '<span class="text-danger">Not paid</span>';
                    if($data->status == Deposit::ACTIVE) return '<span class="text-info">Active</span>';
                    if($data->status == Deposit::FINISHED) return '<span class="text-warning">Finished</span>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
