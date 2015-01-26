<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryNote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-note-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'colorcode')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <?= $form->field($model, 'poc')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'partner_shipping_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'prepare_id')->textInput() ?>

    <?= $form->field($model, 'ekspedisi')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'jumlah_coli')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'terms')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'special')->checkbox() ?>

    <?= $form->field($model, 'work_order_id')->textInput() ?>

    <?= $form->field($model, 'work_order_in')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
