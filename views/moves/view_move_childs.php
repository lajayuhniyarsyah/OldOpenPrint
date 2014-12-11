<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'create_uid',
        'create_date',
        'write_date',
        'product_qty',
        'picking_id',
    ],
]) ?>


<?php
echo  Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Yii::$app->urlManager->createUrl(['moves/generate-product-set','id'=>$model->id,'product_id'=>$model->product_id]));
?>
<?= yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'picking_id',
            'product_uom',
            'product_uos_qty',
            'product_qty',
            'name',
            'product_id',
           
        ],
    ]); ?>


