<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MrpBomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mrp-bom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'date_stop') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'product_uom') ?>

    <?php // echo $form->field($model, 'product_uos_qty') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'product_qty') ?>

    <?php // echo $form->field($model, 'product_uos') ?>

    <?php // echo $form->field($model, 'product_efficiency') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'product_rounding') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'sequence') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'routing_id') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'bom_id') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
