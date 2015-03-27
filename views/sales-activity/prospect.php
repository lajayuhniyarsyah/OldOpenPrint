<?php
use yii\web\View;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;

use yii\web\JsExpression;
?>
<div class="customer-prospect-report">
    <h1>
        Customer Prospect Report
    </h1>
    <?php
    View::registerCssFile('@web/css/bootsnip-timeline.css');

    echo Tabs::widget([
    	// 'renderTabContent'=>false,
        'items' => [
            /*[
                'label'		=> '<span class="glyphicon glyphicon-tasks"></span>',
                'encode'	=> false,
                'content'	=> $this->render('prospect_grid',['dataProvider'=>$dataProvider]),
            ],*/
            [
                'label'		=> '<span class="glyphicon glyphicon-stats"></span>',
                'encode'	=> false,
                'content'	=> $this->render('prospect_chart',['charts'=>$charts]),
                'active'	=> true
            ],
            [
                'label'		=> '<span class="glyphicon glyphicon-search"></span>',
                'encode'	=> false,
                'content'	=> $this->render('_search',['model'=>$salesActivityForm])
            ],
        ],
    ]);
    ?>


    <div class="grid-executive-summary">

        
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Followed Projects</h3>
            </div>
            <div class="panel-body">
                <?php //Pjax::begin(['id'=>'pjax-prospect-grouped']); ?>
                <?=GridView::widget([
                    'id'=>'prospectGrid',
                    'dataProvider'=>$dataProvider,
                    'showPageSummary'=>true,
                    // 'pjax'=>true,
                    'columns'=>[
                        // 'id',
                        [
                            'class'=>'kartik\grid\ExpandRowColumn',
                            'width'=>'50px',
                            'value'=>function ($model, $key, $index, $column) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detailUrl'=>\yii\helpers\Url::to(['sales-activity/prospect-grid']),
                            /*'detail'=>function ($model, $key, $index, $column) {
                                return Yii::$app->controller->renderPartial('prospect_expand_grid', ['model'=>$model]);
                            },*/
                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
                        ],
                        'year',
                        'state',
                        [
                            'attribute'=>'cout',
                            'header'=>'Count',
                            'value'=>function($model,$key,$index,$grid){
                                return $model['cout'].' time(s)';
                            }
                        ]
                    ]
                ])?>

                <?php //Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>