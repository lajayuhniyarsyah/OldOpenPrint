<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchaseOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Purchase Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            // 'origin',
            // 'journal_id',
            // 'date_order',
            // 'partner_id',
            // 'dest_address_id',
            // 'fiscal_position',
            // 'amount_untaxed',
            // 'location_id',
            // 'company_id',
            // 'amount_tax',
            // 'state',
            // 'pricelist_id',
            // 'warehouse_id',
            // 'payment_term_id',
            // 'partner_ref',
            // 'date_approve',
            // 'amount_total',
            // 'name',
            // 'notes:ntext',
            // 'invoice_method',
            // 'shipped:boolean',
            // 'validator',
            // 'minimum_planned_date',
            // 'subcont_type',
            // 'rm_sent:boolean',
            // 'yourref:ntext',
            // 'port_moved0',
            // 'note:ntext',
            // 'other:ntext',
            // 'jenis',
            // 'type_permintaan',
            // 'no_fpb',
            // 'duedate',
            // 'term_of_payment:ntext',
            // 'scheduleddate',
            // 'print_line',
            // 'attention',
            // 'port',
            // 'delivery:ntext',
            // 'after_shipment:ntext',
            // 'total_price',
            // 'shipment_to:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
