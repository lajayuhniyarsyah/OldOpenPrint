<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-order-view">

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
            'journal_id',
            'date_order',
            'partner_id',
            'dest_address_id',
            'fiscal_position',
            'amount_untaxed',
            'location_id',
            'company_id',
            'amount_tax',
            'state',
            'pricelist_id',
            'warehouse_id',
            'payment_term_id',
            'partner_ref',
            'date_approve',
            'amount_total',
            'name',
            'notes:ntext',
            'invoice_method',
            'shipped:boolean',
            'validator',
            'minimum_planned_date',
            'subcont_type',
            'rm_sent:boolean',
            'yourref:ntext',
            'port_moved0',
            'note:ntext',
            'other:ntext',
            'jenis',
            'type_permintaan',
            'no_fpb',
            'duedate',
            'term_of_payment:ntext',
            'scheduleddate',
            'print_line',
            'attention',
            'port',
            'delivery:ntext',
            'after_shipment:ntext',
            'total_price',
            'shipment_to:ntext',
        ],
    ]) ?>

</div>
