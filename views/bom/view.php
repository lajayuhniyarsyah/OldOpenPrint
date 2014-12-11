<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MrpBom */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mrp Boms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrp-bom-view">

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
            // 'create_uid',
            // 'create_date',
            // 'write_date',
            // 'write_uid',
            // 'date_stop',
            // 'code',
            // 'product_uom',
            // 'product_uos_qty',
            // 'date_start',
            'product_qty',
            // 'product_uos',
            'product_efficiency',
            // 'active:boolean',
            // 'product_rounding',
            'name',
            // 'sequence',
            // 'company_id',
            // 'routing_id',
            'product.name_template',
            // 'bom_id',
            // 'position',
            'type',
        ],
    ]) ?>

    <?= yii\grid\GridView::widget([
        'dataProvider' => $moves['dataProvider'],
        'filterModel' => $moves['searchModel'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'picking_id',
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
            [
                'header'=>'Childs',
                'value'=>function($data){
                    $check= app\models\StockMove::find()->where(['move_dest_id'=>$data->id])->count();
                    return $check;
                }
            ],
            // 'bom_id',
            // 'position',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function($url,$model,$Key){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Yii::$app->urlManager->createUrl(['moves/view-move-childs','id'=>$model->id]));
                    }
                ],

            ],
        ],
    ]); ?>
    
</div>
