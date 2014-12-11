<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MrpBomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mrp Boms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrp-bom-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mrp Bom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'create_uid',
            // 'create_date',
            // 'write_date',
            // 'write_uid',
            // 'date_stop',
            // 'code',
            'product_uom',
            'product_uos_qty',
            // 'date_start',
            'product_qty',
            // 'product_uos',
            // 'product_efficiency',
            // 'active:boolean',
            // 'product_rounding',
            'name',
            // 'sequence',
            // 'company_id',
            // 'routing_id',
            'product_id',
            // 'bom_id',
            // 'position',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
