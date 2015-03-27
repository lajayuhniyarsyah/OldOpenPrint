<?php
use miloschuman\highcharts\Highcharts;
\miloschuman\highcharts\HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']); #for drill down
?>
<?php
foreach($charts as $chart):
	// print_r(\yii\helpers\Json::encode($pie['drillDown']));
	echo HighCharts::widget([
		'options'=>[
			'title'=>['text'=>'Prospect In Year'],
			'chart'=>[

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
			'series'=>$chart['series'],
			'plotOptions'=>[
				'series'=>[
					'cursor'=>'pointer',
					'events'=>[
						'click'=>new \yii\web\JsExpression('function(e){
							chart.showLoading(\'Please Wait...\');
							console.log(e.point.id);
							jQuery.get("'.\yii\helpers\Url::to(['sales-activity/get-chart-prospect-by-customer']).'",{"param":e.point.id},function(data){
								chart.addSeriesAsDrilldown(e.point,jQuery.parseJSON(data));
								chart.hideLoading();
							});
							chart.hideLoading();
						}'),
					]
				]
			],
			/*'series'=>[
				[
					'type'=>'pie',
					'name'=>"Customer Activity Composition",
					"data"=>$chart['series'],
				]
			],*/
		]
	]);
endforeach;
?>