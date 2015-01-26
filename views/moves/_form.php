<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockPicking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-picking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'date_done')->textInput() ?>

    <?= $form->field($model, 'min_date')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <?= $form->field($model, 'stock_journal_id')->textInput() ?>

    <?= $form->field($model, 'backorder_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'move_type')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'invoice_state')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'location_dest_id')->textInput() ?>

    <?= $form->field($model, 'max_date')->textInput() ?>

    <?= $form->field($model, 'auto_picking')->checkbox() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'purchase_id')->textInput() ?>

    <?= $form->field($model, 'sale_id')->textInput() ?>

    <?= $form->field($model, 'invoice_id')->textInput() ?>

    <?= $form->field($model, 'carrier_tracking_ref')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'number_of_packages')->textInput() ?>

    <?= $form->field($model, 'carrier_id')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'weight_uom_id')->textInput() ?>

    <?= $form->field($model, 'weight_net')->textInput() ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'note_id')->textInput() ?>

    <?= $form->field($model, 'cust_doc_ref')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'lbm_no')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'isset_set')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
