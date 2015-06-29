<?php
/*$this->beginPage();
$this->beginBody();*/
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;
?>
<div class="grid-executive-summary">

	<h1>
		
	</h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Followed Projects</h3>
		</div>
		<div class="panel-body">
			<?php Pjax::begin(['id'=>'detail-grid']); ?>
			<?=GridView::widget([
				'id'=>'prospectDetailGrid',
				'dataProvider'=>$dataProvider,
				'pjax'=>true,
				'columns'=>[
					 [
		                            'class'=>'kartik\grid\ExpandRowColumn',
		                            'width'=>'50px',
		                            'value'=>function ($model, $key, $index, $column) {
		                                return GridView::ROW_COLLAPSED;
		                            },
		                            'detailUrl'=>\yii\helpers\Url::to(['#']),
		                            /*'detail'=>function ($model, $key, $index, $column) {
		                                return Yii::$app->controller->renderPartial('prospect_expand_grid', ['model'=>$model]);
		                            },*/
		                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
		                        ],
		                        'partner',
		                        'product',
		                        [
		                        	'attribute'=>'qty',
		                            'header'=>'Qty',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['total'],2,',','.');
		                            }
		                        ],
		                        [
		                        	'attribute'=>'price_unit',
		                            'header'=>'Price Unit',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['price_unit'],2,',','.');
		                            }
		                        ],
		                        [
		                            'attribute'=>'cout',
		                            'header'=>'Count',
		                            'value'=>function($model,$key,$index,$grid){
		                            	// return 0;
		                                return app\components\NumericLib::indoStyle($model['total'],2,',','.');
		                            }
		                        ],
		                        'pricelist',
		                        'state',
		                        
				]
			])?>

			<?php Pjax::end(); ?>
		</div>
	</div>
</div>
<?php
/*$this->endBody();
$this->endPage();*/
?>