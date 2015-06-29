<?php
use yii\helpers\Html;
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;

\miloschuman\highcharts\HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
?>

<div class="chart-executive-summary-by-sales-man">

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

			<?=HighCharts::widget([
				'id'=>'stackedChartSalesAchievement',
				'options'=>[
					'title'=>'Target Achievement',
					'chart'=>[
						'type'=>'column',
					],
					'xAxis'=>[
						'type'=>'category'
					],

					'plotOptions'=>[
						'column'=>[
							'grouping'=>false, #grouping to stacked bar
							'shadow'=>false,
							'borderWidth'=>0
						]
					],
					'yAxis'=>[
						[
							'min'=>0,
							'title'=>[
								'text'=>'Employees'
							],
							'title'=>[
								'text'=>'Sales Man'
							],
							'title'=>[
								'text'=>'Values'
							],
							'opposite'=>true
						],
					],
					'series'=>$chart['series'],
					/*'series'=>[
						[
							'name'=>'Ytd Target',
							'data'=>[150,73,20],
							'pointPadding'=>0.3,
							'pointPlacement'=>-0.1,
						],
						[
							'name'=>'Actual',
							'data'=>[140, 90, 40],
							'pointPadding'=>0.4,
							'pointPlacement'=>-0.1,
						],
					]*/
				]
			])
			?>
		</div>
	</div>
</div>
