<?php
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;

\miloschuman\highcharts\HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
?>
<div class="account-invoice-index">
	<form></form>
	<h1>
		<?=$this->title?>
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
						'click'=>[
							'click'=>new \yii\web\JsExpression('function(e){
								/*console.log(e.point.condition);
								chart.showLoading(\'Please Wait...\');*/
								/*$(this).toggleClass(\'modal\');
								$(\'.chart\', this).highcharts().reflow();*/
							}')
						]
					],
					'xAxis'=>[
						// 'categories'=>$chart['groups'],
						'type'=>'category',
						'labels'=>[
							'formatter'=>new \yii\web\JsExpression('function(){
								return \'<a href="'.\yii\helpers\Url::to(['executive-summary-by-sales-man','year'=>$year]).'&gid=\'+this.value+\'">\'+this.value+\'</a>\';
							}'),
						]

					],
					'tooltip'=>[
						// 'pointFormat'=>'<span style="color:{point.color}"></span>{series.name}: <b>{point.y}</b><br/>',
						'valuePrefix'=>'Rp',
						'shared'=>true,
					],

					'plotOptions'=>[
						'column'=>[
							'grouping'=>false, #grouping to stacked bar
							'shadow'=>false,
							'borderWidth'=>0
						],
						'series'=>[
							/*'dataLabels'=>[
								'enabled'=>true,
								'format'=>'{point.y:.1f}%'
							],*/
							'cursor'=>'pointer',
							'point'=>[
								'events'=>[
									'click'=>new \yii\web\JsExpression('function(e){
										chart.showLoading(\'Please Wait...\');
										// console.log(e.point.name);
										jQuery.get("'.\yii\helpers\Url::to(['account-invoice/get-ess-group-detail']).'",{"group":e.point.name,"series":this.series.name},function(data){
											chart.addSeriesAsDrilldown(e.point,jQuery.parseJSON(data));
											
											chart.hideLoading();
										});
										// chart.addSeriesAsDrilldown(e.point,jQuery.parseJSON("[{\"name\":\"Ytd Target\",\"data\":[\"7750000000\",null],\"stack\":0},{\"name\":\"Actual\",\"data\":[\"360414450.0000\",\"107701754.6000\"],\"stack\":0}]"));
										
										chart.hideLoading();
									}')
								]
							]
						]
					],
					/*'yAxis'=>[
						[
							'min'=>0,
							'title'=>[
								'text'=>'Employees'
							],
							'title'=>[
								'text'=>'Profit (millions)'
							],
							'title'=>[
								'text'=>'Invoiced'
							],
							'opposite'=>true
						],
					],*/
					#'series'=>[
						/*[
							'name'=>'Ytd Target',
							'data'=>$chart['ytd_target'],
							'pointPadding'=>0.3,
							'pointPlacement'=>-0.1,
						],
						[
							'name'=>'Actual',
							'data'=>$chart['ytd_sales_achievement'],
							'pointPadding'=>0.4,
							'pointPlacement'=>-0.1,
						],*/
						/*[
							'name'=>'Ytd Target',
							'data'=>[
								['name'=>'Sales Name','y'=>100],
								['name'=>'Sales Name','y'=>200],
							],
							'pointPadding'=>0.3,
							'pointPlacement'=>-0.1,
						],

						[
							'name'=>'Ytd Actual',
							'data'=>[
								['name'=>'Sales Name','y'=>300],
								['name'=>'Sales Name','y'=>400],
							],
							'pointPadding'=>0.4,
							'pointPlacement'=>-0.1,
						],*/
					#],
					'series'=>$chart['series'],
					'drilldown'=>[
						'series'=>[],
					]
				]
			])
			?>
		</div>
	</div>
</div>