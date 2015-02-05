<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'order_policy')->textInput() ?>

    <?= $form->field($model, 'shop_id')->textInput() ?>

    <?= $form->field($model, 'client_order_ref')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'date_order')->textInput() ?>

    <?= $form->field($model, 'partner_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fiscal_position')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'payment_term')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'amount_tax')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'pricelist_id')->textInput() ?>

    <?= $form->field($model, 'partner_invoice_id')->textInput() ?>

    <?= $form->field($model, 'amount_untaxed')->textInput() ?>

    <?= $form->field($model, 'date_confirm')->textInput() ?>

    <?= $form->field($model, 'amount_total')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'partner_shipping_id')->textInput() ?>

    <?= $form->field($model, 'invoice_quantity')->textInput() ?>

    <?= $form->field($model, 'picking_policy')->textInput() ?>

    <?= $form->field($model, 'incoterm')->textInput() ?>

    <?= $form->field($model, 'shipped')->checkbox() ?>

    <?= $form->field($model, 'carrier_id')->textInput() ?>

    <?= $form->field($model, 'worktype')->textInput() ?>

    <?= $form->field($model, 'delivery_date')->textInput() ?>

    <?= $form->field($model, 'week')->textInput() ?>

    <?= $form->field($model, 'sow12')->checkbox() ?>

    <?= $form->field($model, 'sow11')->checkbox() ?>

    <?= $form->field($model, 'sowC')->checkbox() ?>

    <?= $form->field($model, 'sowA')->checkbox() ?>

    <?= $form->field($model, 'sow9')->checkbox() ?>

    <?= $form->field($model, 'sow8')->checkbox() ?>

    <?= $form->field($model, 'sow3')->checkbox() ?>

    <?= $form->field($model, 'sow2')->checkbox() ?>

    <?= $form->field($model, 'sow1')->checkbox() ?>

    <?= $form->field($model, 'sow7')->checkbox() ?>

    <?= $form->field($model, 'sow6')->checkbox() ?>

    <?= $form->field($model, 'sow5')->checkbox() ?>

    <?= $form->field($model, 'sow4')->checkbox() ?>

    <?= $form->field($model, 'sowB')->checkbox() ?>

    <?= $form->field($model, 'sow14')->checkbox() ?>

    <?= $form->field($model, 'sow13')->checkbox() ?>

    <?= $form->field($model, 'sow10')->checkbox() ?>

    <?= $form->field($model, 'kondisi3')->checkbox() ?>

    <?= $form->field($model, 'kondisi2')->checkbox() ?>

    <?= $form->field($model, 'kondisi1')->checkbox() ?>

    <?= $form->field($model, 'attention_moved0')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'attention')->textInput() ?>

    <?= $form->field($model, 'internal_notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
