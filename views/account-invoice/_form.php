<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountInvoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'date_due')->textInput() ?>

    <?= $form->field($model, 'check_total')->textInput() ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'supplier_invoice_number')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'account_id')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <?= $form->field($model, 'fiscal_position')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'partner_bank_id')->textInput() ?>

    <?= $form->field($model, 'payment_term')->textInput() ?>

    <?= $form->field($model, 'reference_type')->textInput() ?>

    <?= $form->field($model, 'journal_id')->textInput() ?>

    <?= $form->field($model, 'amount_tax')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'internal_number')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'reconciled')->checkbox() ?>

    <?= $form->field($model, 'residual')->textInput() ?>

    <?= $form->field($model, 'move_name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'date_invoice')->textInput() ?>

    <?= $form->field($model, 'period_id')->textInput() ?>

    <?= $form->field($model, 'amount_untaxed')->textInput() ?>

    <?= $form->field($model, 'move_id')->textInput() ?>

    <?= $form->field($model, 'amount_total')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sent')->checkbox() ?>

    <?= $form->field($model, 'commercial_partner_id')->textInput() ?>

    <?= $form->field($model, 'kmk')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'faktur_pajak_no')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'kwitansi')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'pajak')->textInput() ?>

    <?= $form->field($model, 'kurs')->textInput() ?>

    <?= $form->field($model, 'approver')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
