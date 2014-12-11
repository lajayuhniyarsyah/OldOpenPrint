<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockPickingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Pickings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-picking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stock Picking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Check Stock SET', ['product-set'], ['class' => 'btn btn-success']) ?>
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
            // 'date_done',
            // 'min_date',
            // 'date',
            // 'partner_id',
            // 'stock_journal_id',
            // 'backorder_id',
            // 'name',
            // 'location_id',
            // 'move_type',
            // 'company_id',
            // 'invoice_state',
            // 'note:ntext',
            // 'state',
            // 'location_dest_id',
            // 'max_date',
            // 'auto_picking:boolean',
            // 'type',
            // 'purchase_id',
            // 'sale_id',
            // 'invoice_id',
            // 'carrier_tracking_ref',
            // 'number_of_packages',
            // 'carrier_id',
            // 'weight',
            // 'weight_uom_id',
            // 'weight_net',
            // 'volume',
            // 'note_id',
            // 'cust_doc_ref',
            // 'lbm_no',
            // 'isset_set:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
