<?php

use app\models\DepositEntity;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model DepositEntity */

$this->title = 'Edit deposit: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="base-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
