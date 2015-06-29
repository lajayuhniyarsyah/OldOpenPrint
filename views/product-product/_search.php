<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'ean13') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'price_extra') ?>

    <?php // echo $form->field($model, 'default_code') ?>

    <?php // echo $form->field($model, 'name_template') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'variants') ?>

    <?php // echo $form->field($model, 'image_medium') ?>

    <?php // echo $form->field($model, 'image_small') ?>

    <?php // echo $form->field($model, 'product_tmpl_id') ?>

    <?php // echo $form->field($model, 'price_margin') ?>

    <?php // echo $form->field($model, 'track_outgoing')->checkbox() ?>

    <?php // echo $form->field($model, 'track_incoming')->checkbox() ?>

    <?php // echo $form->field($model, 'valuation') ?>

    <?php // echo $form->field($model, 'track_production')->checkbox() ?>

    <?php // echo $form->field($model, 'partner_code') ?>

    <?php // echo $form->field($model, 'expired_date') ?>

    <?php // echo $form->field($model, 'batch_code') ?>

    <?php // echo $form->field($model, 'partner_desc') ?>

    <?php // echo $form->field($model, 'not_stock')->checkbox() ?>

    <?php // echo $form->field($model, 'is_rent_item')->checkbox() ?>

    <?php // echo $form->field($model, 'hr_expense_ok')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
