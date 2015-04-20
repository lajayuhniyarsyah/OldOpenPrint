<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;

use yii\web\JsExpression;
?>

<div class="grid-executive-summary">

	<h1>
		<?=$this->title?>
		<span id="salesListTitle" class="dropdown">
			
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode((isset($salesTitle) ? $salesTitle:'All Sales'))?></a>
			<?php
				$items = [
					['label' => 'G1', 'url' => ['','gid'=>1,'year'=>$year]],
					['label' => 'G2', 'url' => ['','gid'=>2,'year'=>$year]],
					['label' => 'G3', 'url' => ['','gid'=>3,'year'=>$year]],
					['label' => 'G4', 'url' => ['','gid'=>4,'year'=>$year]],
					['label' => 'G5', 'url' => ['','gid'=>5,'year'=>$year]],
					['label' => 'G6', 'url' => ['','gid'=>6,'year'=>$year]],
					['label' => 'Jabotabek', 'url' => ['','gid'=>7,'year'=>$year]],
					['label' => 'SMB', 'url' => ['','gid'=>8,'year'=>$year]],
					['label' => 'JTT', 'url' => ['','gid'=>10,'year'=>$year]],
					['label' => 'SLS', 'url' => ['','gid'=>11,'year'=>$year]],
				];
				
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
		On
		<span id="yearTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=$year?></a>
			<?php
				$start = 2014;
				$end = date('Y');
				$items = [];
				for($iYear=$start;$iYear<=$end;$iYear++){
					$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear]];
				}
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
	</h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Target Vs Actual</h3>
		</div>
		<div class="panel-body">

			<?=GridView::widget([
				'id'=>'executiveSummaryGrid',
				'dataProvider'=>$provider,
				'showPageSummary'=>true,
				'beforeHeader'=>[
					[
						'columns'=>[
							['content'=>'','options'=>['colspan'=>2,'class'=>'text-center']],
							['content'=>'Target','options'=>['colspan'=>2,'class'=>'text-center']],
							['content'=>'Achievement','options'=>['colspan'=>2,'class'=>'text-center']],
						]
					]
				],
				'columns'=>[
					'year_invoice',
					'name',
					[
						'attribute'=>'amount_target',
						'pageSummary'=>true,
						'format'=>'currency',
					],
					[
						'attribute'=>'ytd_target',
						'pageSummary'=>true,
						'format'=>'currency',
					],
					[
						'attribute'=>'ytd_sales_achievement',
						'pageSummary'=>true,
						'format'=>'currency',
					],
					[
						'attribute'=>'achievement',
						'value'=>function($model,$key,$row,$grid){
							return ($model['achievement'] ? $model['achievement']:0).'%';
						}
					]
				]
			])?>
		</div>
	</div>
</div>