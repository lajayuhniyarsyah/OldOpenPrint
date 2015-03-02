<?php
use miloschuman\highcharts\Highcharts;
\miloschuman\highcharts\HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']); #for drill down
?>
<?php
if($charts && $charts['pie']):
	foreach($charts['pie'] as $pie):
		// print_r(\yii\helpers\Json::encode($pie['drillDown']));
		echo HighCharts::widget([
			'options'=>[
				'title'=>['text'=>$pie['title']],
				'chart'=>[
					'events'=>[
						'drilldown'=>new \yii\web\JsExpression('function(e){
							chart.setTitle({text: "'.$pie['drillDownTitle'].'"});
							console.log("'.$pie['drillDownTitle'].'");
							console.log(e.point.condition);
							chart.showLoading(\'Please Wait...\');
							jQuery.get("'.\yii\helpers\Url::to(['sales-activity/get-drill-down']).'",jQuery.parseJSON(e.point.condition),function(data){
								chart.addSeriesAsDrilldown(e.point,jQuery.parseJSON(data));
								chart.hideLoading();
							});
							/*chart.addSeriesAsDrilldown(e.point,{
								name:"Drilled Drill",
								type:"pie",
								data:[
									["Point 1",100],
									["Point 2",80],
									["Point 3",10],
								]
							});*/
							
						}'),
						'drillup'=>new \yii\web\JsExpression('function(e){
							chart.setTitle({text: "'.$pie['title'].'"});
						}'),
					],

				],
				'plotOptions'=>[
					'pie'=>[
						'allowPointSelect'=>true,
						'cursor'=>'pointer',
						'dataLabels'=>[
							'enabled'=>true,
							'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'
						]
					]
				],
				'xAxis'=>['type'=>'category'],
				'series'=>[
					[
						'type'=>'pie',
						'name'=>"Customer Activity Composition",
						"data"=>$pie['series'],
					]
				],
				'drilldown'=>[
					'series'=>$pie['drillDown']
					/*'series'=>[
						[
							'id'=>'drill1',
							'name'=>'drill1',
							'type'=>'bar',
							'data'=>[
								[
									'Cat1',10
								],
								[
									'Cat2',rand(1,10),
								],
								[
									'Cat3',rand(1,10),
								],
							]
							
						],
					],*/
				]
			]
		]);
	endforeach;
endif;
?>