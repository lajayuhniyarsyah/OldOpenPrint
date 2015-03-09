<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use kartik\grid\ExpandRowColumn;
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
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'product_uom',
            'product_uos_qty',
            'product_qty',
            'name',
            'product_id',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
         'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Header Before 1', 'options'=>['colspan'=>5, 'class'=>'text-center warning']],
                    ['content'=>'Header Before 2', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],
                    ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],
                    ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],

     'export' => [
        'fontAwesome' => true
      ],
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'MRP BOM',
    ],
    'exportConfig' => true,
    ]); ?>

</div>
