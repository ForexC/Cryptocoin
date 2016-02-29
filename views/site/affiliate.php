<?php

/* @var $this yii\web\View */
/* @var $userId integer */
/* @var $user UserEntity */

use app\models\UserEntity;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name.' - Affiliate program';
$this->params['breadcrumbs'][] = 'Affiliate program';
?>
<div class="site-about">
    <h1>Affiliate program</h1>

    <p>
    <h2>Unique affiliate link</h2>
    Your affiliate link: <?= Url::toRoute(['site/index', 'ref' => $userId], true) ?>

    <h2>Statistics</h2>
    Current payout address: <?= $user->address ?>

    <?php $form = ActiveForm::begin(['id' => 'affiliate-form']); ?>

    <?= $form->field($affiliateForm, 'address')->textInput(['autofocus' => true , 'placeholder'=>'Enter new payout address']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'affiliate-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </p>

</div>
