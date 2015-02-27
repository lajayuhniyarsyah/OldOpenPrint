<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sales Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=GridView::widget([
        'dataProvider' => $salesData,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                        //  '<a href="/OpenPrint/web/index.php/sales-activity/view?id=0" title="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['view-time-line','uid'=>$model->id]);
                    }
                ]
            ],
        ],
    ]);
    ?>

</div>
