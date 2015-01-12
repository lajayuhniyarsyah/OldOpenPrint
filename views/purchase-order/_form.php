<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'journal_id')->textInput() ?>

    <?= $form->field($model, 'date_order')->textInput() ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <?= $form->field($model, 'dest_address_id')->textInput() ?>

    <?= $form->field($model, 'fiscal_position')->textInput() ?>

    <?= $form->field($model, 'amount_untaxed')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'amount_tax')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'pricelist_id')->textInput() ?>

    <?= $form->field($model, 'warehouse_id')->textInput() ?>

    <?= $form->field($model, 'payment_term_id')->textInput() ?>

    <?= $form->field($model, 'partner_ref')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'date_approve')->textInput() ?>

    <?= $form->field($model, 'amount_total')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'invoice_method')->textInput() ?>

    <?= $form->field($model, 'shipped')->checkbox() ?>

    <?= $form->field($model, 'validator')->textInput() ?>

    <?= $form->field($model, 'minimum_planned_date')->textInput() ?>

    <?= $form->field($model, 'subcont_type')->textInput() ?>

    <?= $form->field($model, 'rm_sent')->checkbox() ?>

    <?= $form->field($model, 'yourref')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'port_moved0')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis')->textInput() ?>

    <?= $form->field($model, 'type_permintaan')->textInput() ?>

    <?= $form->field($model, 'no_fpb')->textInput() ?>

    <?= $form->field($model, 'duedate')->textInput() ?>

    <?= $form->field($model, 'term_of_payment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'scheduleddate')->textInput() ?>

    <?= $form->field($model, 'print_line')->textInput() ?>

    <?= $form->field($model, 'attention')->textInput() ?>

    <?= $form->field($model, 'port')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'delivery')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'after_shipment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'shipment_to')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
