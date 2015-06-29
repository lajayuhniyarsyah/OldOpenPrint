<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProduct */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-product-view">

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
            'ean13',
            'color',
            'image',
            'price_extra',
            'default_code',
            'name_template',
            'active:boolean',
            'variants',
            'image_medium',
            'image_small',
            'product_tmpl_id',
            'price_margin',
            'track_outgoing:boolean',
            'track_incoming:boolean',
            'valuation',
            'track_production:boolean',
            'partner_code',
            'expired_date',
            'batch_code',
            'partner_desc',
            'not_stock:boolean',
            'is_rent_item:boolean',
            'hr_expense_ok:boolean',
        ],
    ]) ?>

</div>
