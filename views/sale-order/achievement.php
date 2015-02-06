<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\grid\GridView;

?>
<?php 
$form = ActiveForm::begin([
	'id'=>'saleAnnualReportForm',
	'action'=>[''],
	'method'=>'get',
]);
?>
<?='<label class="control-label">Provinces</label>'?>

<?=Select2::widget([
	'name' => 'sales',
	'data' => \yii\helpers\ArrayHelper::merge($saleUsers,[0=>"All Sales"]),
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
		'format' => 'dd-M-yyyy',
		'autoclose' => true,
		'startDate'=>'01/07/2014',
	]
]);?>
<div class="form-group">
    <?= Html::submitButton('Search', ['class' =>'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
// var_dump($series);
echo \dosamigos\highcharts\HighCharts::widget([
    'clientOptions' => [
        'chart' => [
                'type' => 'line'
        ],
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
		<h3 class="panel-title">Monthly Order Received By Sale User</h3>
	</div>
	<div class="panel-body">
		<?=GridView::widget([
			'dataProvider'=>$salesManSearchGrid['dataProvider'],
			'showPageSummary' => true,
			'columns'=>$salesManSearchGrid['columns']
		]);?>
	</div>
</div>
	<?php
}