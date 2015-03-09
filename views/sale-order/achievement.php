<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\grid\GridView;

use miloschuman\highcharts\Highcharts;

?>
<?php
$this->title = 'Order Received Dashboard';
$this->params['breadcrumbs'][] = ['label'=>'Sale Order','url'=>['index']];
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id'=>'saleAnnualReportForm',
	'action'=>[''],
	'method'=>'get',
]);
?>
<?='<label class="control-label">Sales Man/Group/Site</label>'?>

<?=Select2::widget([
	'name' => 'sales',
	'data' => \yii\helpers\ArrayHelper::merge(
		$saleUsers,
		[
			'all'=>"All Sales",
			"group:g1"=>"Group: G1",
			"group:g2"=>"Group: G2",
			"group:g3"=>"Group: G3",
			"group:g4"=>"Group: G4",
			"group:g5"=>"Group: G5",
			"group:g6"=>"Group: G6",
			"group:jabotabek"=>"Group: JABODETABEK",
			"group:smb"=>'Group: SMB / Sumatera',
			"group:jtt"=>"Group: Jawa Tengah / Timur",
			"group:sls"=>"Group: Sulawesi",
		]
	),
	'value'=>Yii::$app->request->get('sales'),
	'options' => [
		'placeholder' => 'Select Sales ...',
		'multiple' => true,
	],
]);?>
<?=DatePicker::widget([
	'model' => $model,
	'attribute' => 'date_from',
	'attribute2' => 'date_to',
	'options' => ['placeholder' => 'Start date'],
	'options2' => ['placeholder' => 'End date'],
	'type' => DatePicker::TYPE_RANGE,
	'form' => $form,
	'pluginOptions' => [
		'format' => 'yyyy-MM-dd',
		// 'format' => 'dd-MM-yyyy',
		'autoclose' => true,
		'startDate'=>'01/07/2014',
	],
	'convertFormat'=>true,
]);?>
<div class="form-group">
    <?= Html::submitButton('Search', ['class' =>'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
// var_dump($series);
echo HighCharts::widget([
    'options' => [
        /*'chart' => [
                'type' => 'line'
        ],*/
        'legend'=>[
        	// 'layout'=>'vertical',
        	// 'verticalAlign'=>'top',
        	// 'floating'=>true,
        	'itemWidth'=>150,
        	/*'x'=>90,
        	'y'=>45,*/
        ],
        'title' => [
             'text' => 'Sale Order Received'
             ],
        'xAxis' => [
            'categories' => $chart['xCategories']
        ],
        'yAxis' => [
            'title' => [
                'text' => 'Order (IDR)'
            ]
        ],
        'series' => $chart['series']
    ]
]);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?=Html::encode($allOrderTitle)?></h3>
	</div>
	<div class="panel-body">
		<?=GridView::widget([
			'dataProvider'=>$allOrderDataProvider,
			'showPageSummary' => true,
			'columns'=>[
				[
					'attribute'=>'month_name',
					'header'=>'Period(s)',
				],
				[
					'attribute'=>'subtotal_week_1',
					'header'=>"Week 1",
					'format'=>['currency']
				],
				[
					'attribute'=>'subtotal_week_2',
					'header'=>"Week 2",
					'format'=>['currency']
				],
				[
					'attribute'=>'subtotal_week_3',
					'header'=>"Week 3",
					'format'=>['currency']
				],
				[
					'attribute'=>'subtotal_week_4',
					'header'=>"Week 4",
					'format'=>['currency']
				],
				[
					'attribute'=>'subtotal_week_5',
					'header'=>"Week 5",
					'format'=>['currency']
				],
				[
					'attribute'=>'subtotal',
					'header'=>"Total",
					'pageSummary'=>true,
					'format'=>['currency']
				]
			]
		]);?>
	</div>
</div>


<?php
if(isset($salesManSearchGrid) && $salesManSearchGrid){
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Order Received Composition By Sales Man</h3>
		</div>
		<div class="panel-body">
			<?php
				echo HighCharts::widget([
					'options'=>[
						'title'=>['text'=>'Order Received Composition'],
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
						'series'=>[
							[
								'type'=>'pie',
								'name'=>"Order Receive Composition",
								"data"=>$pieSeries,
							]
						]
					]
				]);
			?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Monthly Order Received By Sales Man</h3>
		</div>
		<div class="panel-body">
			<?=GridView::widget([
				'id'=>'salesManAchievement',
				'tableOptions'=>['id'=>'salesManAchievementTbl'],
				'dataProvider'=>$salesManSearchGrid['dataProvider'],
				'showPageSummary' => true,
				'columns'=>$salesManSearchGrid['columns']
			]);?>
		</div>
	</div>


	
	<?php
}