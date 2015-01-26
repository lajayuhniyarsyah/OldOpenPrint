<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StockPicking */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stock Pickings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-picking-view">

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
            'date_done',
            'min_date',
            'date',
            'partner_id',
            'stock_journal_id',
            'backorder_id',
            'name',
            'location_id',
            'move_type',
            'company_id',
            'invoice_state',
            'note:ntext',
            'state',
            'location_dest_id',
            'max_date',
            'auto_picking:boolean',
            'type',
            'purchase_id',
            'sale_id',
            'invoice_id',
            'carrier_tracking_ref',
            'number_of_packages',
            'carrier_id',
            'weight',
            'weight_uom_id',
            'weight_net',
            'volume',
            'note_id',
            'cust_doc_ref',
            'lbm_no',
            'isset_set:boolean',
        ],
    ]) ?>

</div>
