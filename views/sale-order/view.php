<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaleOrder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sale Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            'origin',
            'order_policy',
            'shop_id',
            'client_order_ref',
            'date_order',
            'partner_id',
            'note:ntext',
            'fiscal_position',
            'user_id',
            'payment_term',
            'company_id',
            'amount_tax',
            'state',
            'pricelist_id',
            'partner_invoice_id',
            'amount_untaxed',
            'date_confirm',
            'amount_total',
            'project_id',
            'name',
            'partner_shipping_id',
            'invoice_quantity',
            'picking_policy',
            'incoterm',
            'shipped:boolean',
            'carrier_id',
            'worktype',
            'delivery_date',
            'week',
            'sow12:boolean',
            'sow11:boolean',
            'sowC:boolean',
            'sowA:boolean',
            'sow9:boolean',
            'sow8:boolean',
            'sow3:boolean',
            'sow2:boolean',
            'sow1:boolean',
            'sow7:boolean',
            'sow6:boolean',
            'sow5:boolean',
            'sow4:boolean',
            'sowB:boolean',
            'sow14:boolean',
            'sow13:boolean',
            'sow10:boolean',
            'kondisi3:boolean',
            'kondisi2:boolean',
            'kondisi1:boolean',
            'attention_moved0',
            'attention',
            'internal_notes:ntext',
            'due_date',
        ],
    ]) ?>

</div>
