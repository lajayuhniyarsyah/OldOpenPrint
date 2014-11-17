<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderPreparationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Preparations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-preparation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Preparation', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'name',
            // 'partner_shipping_id',
            // 'sale_id',
            // 'duedate',
            // 'note:ntext',
            // 'state',
            // 'tanggal',
            // 'picking_id',
            // 'partner_id',
            // 'poc',
            // 'terms:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
