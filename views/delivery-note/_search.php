<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryNoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-note-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'colorcode') ?>

    <?php // echo $form->field($model, 'partner_id') ?>

    <?php // echo $form->field($model, 'poc') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'partner_shipping_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'prepare_id') ?>

    <?php // echo $form->field($model, 'ekspedisi') ?>

    <?php // echo $form->field($model, 'jumlah_coli') ?>

    <?php // echo $form->field($model, 'terms') ?>

    <?php // echo $form->field($model, 'special')->checkbox() ?>

    <?php // echo $form->field($model, 'work_order_id') ?>

    <?php // echo $form->field($model, 'work_order_in') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
