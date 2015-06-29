<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResPartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="res-partner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lang') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'write_date') ?>

    <?php // echo $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'ean13') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'use_parent_address')->checkbox() ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'supplier')->checkbox() ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'function') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'employee')->checkbox() ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'street2') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'credit_limit') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'tz') ?>

    <?php // echo $form->field($model, 'customer')->checkbox() ?>

    <?php // echo $form->field($model, 'image_medium') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'image_small') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'is_company')->checkbox() ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'notification_email_send') ?>

    <?php // echo $form->field($model, 'opt_out')->checkbox() ?>

    <?php // echo $form->field($model, 'signup_type') ?>

    <?php // echo $form->field($model, 'signup_expiration') ?>

    <?php // echo $form->field($model, 'signup_token') ?>

    <?php // echo $form->field($model, 'last_reconciliation_date') ?>

    <?php // echo $form->field($model, 'debit_limit') ?>

    <?php // echo $form->field($model, 'display_name') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'term_payment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
