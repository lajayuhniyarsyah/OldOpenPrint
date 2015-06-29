<?php
use kartik\grid\GridView;
use yii\helpers\Url;

use yii\bootstrap\Dropdown;
use yii\web\JsExpression;
?>

<div class="account-invoice-index">

	<h1>
		<?=$this->title?>
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
					'group_name',
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
					],
					[
						'class'=>'\kartik\grid\ActionColumn',
						'template'=>'{view}',
						'buttons'=>[
							'view'=>function ($url, $model, $key) use($year) {
								$options = [];
								$title = Yii::t('kvgrid', 'View');
				                $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
				                $label = \yii\helpers\ArrayHelper::remove($options, 'label', (false ? $icon . ' ' . $title : $icon));
				                $options = \yii\helpers\ArrayHelper::merge(['title' => $title, 'data-pjax' => '0'], $options);
				                return \yii\helpers\Html::a($label, \yii\helpers\Url::to(['executive-summary-by-sales-man','year'=>$year,'gid'=>$model['gid']]), $options);
							}
						]
					]
				]
			])?>
		</div>
	</div>
</div>