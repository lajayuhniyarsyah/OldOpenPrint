<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-search">

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

    <?php // echo $form->field($model, 'journal_id') ?>

    <?php // echo $form->field($model, 'date_order') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'dest_address_id') ?>

    <?php // echo $form->field($model, 'fiscal_position') ?>

    <?php // echo $form->field($model, 'amount_untaxed') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'amount_tax') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'pricelist_id') ?>

    <?php // echo $form->field($model, 'warehouse_id') ?>

    <?php // echo $form->field($model, 'payment_term_id') ?>

    <?php // echo $form->field($model, 'partner_ref') ?>

    <?php // echo $form->field($model, 'date_approve') ?>

    <?php // echo $form->field($model, 'amount_total') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'invoice_method') ?>

    <?php // echo $form->field($model, 'shipped')->checkbox() ?>

    <?php // echo $form->field($model, 'validator') ?>

    <?php // echo $form->field($model, 'minimum_planned_date') ?>

    <?php // echo $form->field($model, 'subcont_type') ?>

    <?php // echo $form->field($model, 'rm_sent')->checkbox() ?>

    <?php // echo $form->field($model, 'yourref') ?>

    <?php // echo $form->field($model, 'port_moved0') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'jenis') ?>

    <?php // echo $form->field($model, 'type_permintaan') ?>

    <?php // echo $form->field($model, 'no_fpb') ?>

    <?php // echo $form->field($model, 'duedate') ?>

    <?php // echo $form->field($model, 'term_of_payment') ?>

    <?php // echo $form->field($model, 'scheduleddate') ?>

    <?php // echo $form->field($model, 'print_line') ?>

    <?php // echo $form->field($model, 'attention') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'delivery') ?>

    <?php // echo $form->field($model, 'after_shipment') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'shipment_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
