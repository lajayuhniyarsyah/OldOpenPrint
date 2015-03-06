<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalesActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'begin')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
