<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'ean13')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'image')->textInput() ?>

    <?= $form->field($model, 'price_extra')->textInput() ?>

    <?= $form->field($model, 'default_code')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'name_template')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'variants')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'image_medium')->textInput() ?>

    <?= $form->field($model, 'image_small')->textInput() ?>

    <?= $form->field($model, 'product_tmpl_id')->textInput() ?>

    <?= $form->field($model, 'price_margin')->textInput() ?>

    <?= $form->field($model, 'track_outgoing')->checkbox() ?>

    <?= $form->field($model, 'track_incoming')->checkbox() ?>

    <?= $form->field($model, 'valuation')->textInput() ?>

    <?= $form->field($model, 'track_production')->checkbox() ?>

    <?= $form->field($model, 'partner_code')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'expired_date')->textInput() ?>

    <?= $form->field($model, 'batch_code')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'partner_desc')->textInput(['maxlength' => 254]) ?>

    <?= $form->field($model, 'not_stock')->checkbox() ?>

    <?= $form->field($model, 'is_rent_item')->checkbox() ?>

    <?= $form->field($model, 'hr_expense_ok')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
