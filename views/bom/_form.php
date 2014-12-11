<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MrpBom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrp-bom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'date_stop')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'product_uom')->textInput() ?>

    <?= $form->field($model, 'product_uos_qty')->textInput() ?>

    <?= $form->field($model, 'date_start')->textInput() ?>

    <?= $form->field($model, 'product_qty')->textInput() ?>

    <?= $form->field($model, 'product_uos')->textInput() ?>

    <?= $form->field($model, 'product_efficiency')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'product_rounding')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'sequence')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'routing_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'bom_id')->textInput() ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
