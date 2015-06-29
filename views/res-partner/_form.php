<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResPartner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="res-partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ean13')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'image')->textInput() ?>

    <?= $form->field($model, 'use_parent_address')->checkbox() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'supplier')->checkbox() ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => 24]) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'function')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'employee')->checkbox() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 240]) ?>

    <?= $form->field($model, 'vat')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'credit_limit')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'tz')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'customer')->checkbox() ?>

    <?= $form->field($model, 'image_medium')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'image_small')->textInput() ?>

    <?= $form->field($model, 'birthdate')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'is_company')->checkbox() ?>

    <?= $form->field($model, 'state_id')->textInput() ?>

    <?= $form->field($model, 'notification_email_send')->textInput() ?>

    <?= $form->field($model, 'opt_out')->checkbox() ?>

    <?= $form->field($model, 'signup_type')->textInput() ?>

    <?= $form->field($model, 'signup_expiration')->textInput() ?>

    <?= $form->field($model, 'signup_token')->textInput() ?>

    <?= $form->field($model, 'last_reconciliation_date')->textInput() ?>

    <?= $form->field($model, 'debit_limit')->textInput() ?>

    <?= $form->field($model, 'display_name')->textInput() ?>

    <?= $form->field($model, 'npwp')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'term_payment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
