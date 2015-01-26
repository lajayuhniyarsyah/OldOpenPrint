<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockPickingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-picking-search">

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

    <?php // echo $form->field($model, 'date_done') ?>

    <?php // echo $form->field($model, 'min_date') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'stock_journal_id') ?>

    <?php // echo $form->field($model, 'backorder_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'move_type') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'invoice_state') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'location_dest_id') ?>

    <?php // echo $form->field($model, 'max_date') ?>

    <?php // echo $form->field($model, 'auto_picking')->checkbox() ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'purchase_id') ?>

    <?php // echo $form->field($model, 'sale_id') ?>

    <?php // echo $form->field($model, 'invoice_id') ?>

    <?php // echo $form->field($model, 'carrier_tracking_ref') ?>

    <?php // echo $form->field($model, 'number_of_packages') ?>

    <?php // echo $form->field($model, 'carrier_id') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'weight_uom_id') ?>

    <?php // echo $form->field($model, 'weight_net') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'note_id') ?>

    <?php // echo $form->field($model, 'cust_doc_ref') ?>

    <?php // echo $form->field($model, 'lbm_no') ?>

    <?php // echo $form->field($model, 'isset_set')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
