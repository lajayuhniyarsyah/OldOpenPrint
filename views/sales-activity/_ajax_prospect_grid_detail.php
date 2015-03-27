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
		<?=Html::encode(ucwords($state))?> Project On <?=Html::encode($year)?>
	</h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Followed Projects</h3>
		</div>
		<div class="panel-body">
			<?php Pjax::begin(['id'=>'prospect-detail-grid'.$year.$state]); ?>
			<?=GridView::widget([
				'id'=>'prospectDetailGrid'.$year.$state,
				'dataProvider'=>$dataProvider,
				'pjax'=>true,
				'columns'=>[
					[
						'header'=>'Sales Man',
						'value'=>function($model,$key,$index,$grid){
							return $model['status0']['user']['partner']['name'];
						}
					],
					'customer',
					'project',
					'status',
					'order.name',
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