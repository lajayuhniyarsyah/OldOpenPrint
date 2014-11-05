<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountInvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'date_due') ?>

    <?php // echo $form->field($model, 'check_total') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'supplier_invoice_number') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'fiscal_position') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'partner_bank_id') ?>

    <?php // echo $form->field($model, 'payment_term') ?>

    <?php // echo $form->field($model, 'reference_type') ?>

    <?php // echo $form->field($model, 'journal_id') ?>

    <?php // echo $form->field($model, 'amount_tax') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'internal_number') ?>

    <?php // echo $form->field($model, 'reconciled')->checkbox() ?>

    <?php // echo $form->field($model, 'residual') ?>

    <?php // echo $form->field($model, 'move_name') ?>

    <?php // echo $form->field($model, 'date_invoice') ?>

    <?php // echo $form->field($model, 'period_id') ?>

    <?php // echo $form->field($model, 'amount_untaxed') ?>

    <?php // echo $form->field($model, 'move_id') ?>

    <?php // echo $form->field($model, 'amount_total') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'sent')->checkbox() ?>

    <?php // echo $form->field($model, 'commercial_partner_id') ?>

    <?php // echo $form->field($model, 'kmk') ?>

    <?php // echo $form->field($model, 'faktur_pajak_no') ?>

    <?php // echo $form->field($model, 'kwitansi') ?>

    <?php // echo $form->field($model, 'pajak') ?>

    <?php // echo $form->field($model, 'kurs') ?>

    <?php // echo $form->field($model, 'approver') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
