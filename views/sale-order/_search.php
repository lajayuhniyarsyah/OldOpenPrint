<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-order-search">

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

    <?php // echo $form->field($model, 'order_policy') ?>

    <?php // echo $form->field($model, 'shop_id') ?>

    <?php // echo $form->field($model, 'client_order_ref') ?>

    <?php // echo $form->field($model, 'date_order') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'fiscal_position') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'payment_term') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'amount_tax') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'pricelist_id') ?>

    <?php // echo $form->field($model, 'partner_invoice_id') ?>

    <?php // echo $form->field($model, 'amount_untaxed') ?>

    <?php // echo $form->field($model, 'date_confirm') ?>

    <?php // echo $form->field($model, 'amount_total') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'partner_shipping_id') ?>

    <?php // echo $form->field($model, 'invoice_quantity') ?>

    <?php // echo $form->field($model, 'picking_policy') ?>

    <?php // echo $form->field($model, 'incoterm') ?>

    <?php // echo $form->field($model, 'shipped')->checkbox() ?>

    <?php // echo $form->field($model, 'carrier_id') ?>

    <?php // echo $form->field($model, 'worktype') ?>

    <?php // echo $form->field($model, 'delivery_date') ?>

    <?php // echo $form->field($model, 'week') ?>

    <?php // echo $form->field($model, 'sow12')->checkbox() ?>

    <?php // echo $form->field($model, 'sow11')->checkbox() ?>

    <?php // echo $form->field($model, 'sowC')->checkbox() ?>

    <?php // echo $form->field($model, 'sowA')->checkbox() ?>

    <?php // echo $form->field($model, 'sow9')->checkbox() ?>

    <?php // echo $form->field($model, 'sow8')->checkbox() ?>

    <?php // echo $form->field($model, 'sow3')->checkbox() ?>

    <?php // echo $form->field($model, 'sow2')->checkbox() ?>

    <?php // echo $form->field($model, 'sow1')->checkbox() ?>

    <?php // echo $form->field($model, 'sow7')->checkbox() ?>

    <?php // echo $form->field($model, 'sow6')->checkbox() ?>

    <?php // echo $form->field($model, 'sow5')->checkbox() ?>

    <?php // echo $form->field($model, 'sow4')->checkbox() ?>

    <?php // echo $form->field($model, 'sowB')->checkbox() ?>

    <?php // echo $form->field($model, 'sow14')->checkbox() ?>

    <?php // echo $form->field($model, 'sow13')->checkbox() ?>

    <?php // echo $form->field($model, 'sow10')->checkbox() ?>

    <?php // echo $form->field($model, 'kondisi3')->checkbox() ?>

    <?php // echo $form->field($model, 'kondisi2')->checkbox() ?>

    <?php // echo $form->field($model, 'kondisi1')->checkbox() ?>

    <?php // echo $form->field($model, 'attention_moved0') ?>

    <?php // echo $form->field($model, 'attention') ?>

    <?php // echo $form->field($model, 'internal_notes') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
