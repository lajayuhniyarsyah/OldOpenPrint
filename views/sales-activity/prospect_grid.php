<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;

use yii\web\JsExpression;

use yii\widgets\Pjax;
?>

<div class="grid-executive-summary">

	<h1>
		Customer Prospect Report
	</h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Followed Projects</h3>
		</div>
		<div class="panel-body">
			<?php Pjax::begin(); ?>
			<?=GridView::widget([
				'id'=>'prospectGrid',
				'dataProvider'=>$dataProvider,
				'showPageSummary'=>true,
				'pjax'=>true,
				'columns'=>[
					[
						'class'=>'kartik\grid\ExpandRowColumn',
						'width'=>'50px',
						'value'=>function ($model, $key, $index, $column) {
							return GridView::ROW_COLLAPSED;
						},
						// 'detailUrl'=>\yii\helpers\Url::to(['account-invoice/index']),
						'detail'=>function ($model, $key, $index, $column) {
							return Yii::$app->controller->renderPartial('prospect_expand_grid', ['model'=>$model]);
						},
						'headerOptions'=>['class'=>'kartik-sheet-style'] 
					],
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

			<?php Pjax::end(); ?>
		</div>
	</div>
</div>