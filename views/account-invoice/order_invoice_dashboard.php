<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\grid\GridView;
use yii\web\JsExpression;

use miloschuman\highcharts\Highcharts;

?>
<?php
$this->title = 'Invoice Released Summary';
$this->params['breadcrumbs'][] = ['label'=>'Customer Invoice','url'=>['out']];
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
	'id'=>'saleAnnualReportForm',
	'action'=>[''],
	'method'=>'get',
]);
?>
<?='<label class="control-label">Search Form</label>'?>
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
	]
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

?>


<?php
if(isset($resGrid) && $resGrid){
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Invoice Released Composition By Sales Man</h3>
		</div>
		<div class="panel-body">
			<?=HighCharts::widget([
				'options'=>[
					'title'=>['text'=>'Invoice Released Composition'],
					
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
							"data"=>$pie['series'],
						]
					]
				]
			])?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Summary Invoice Released<?=$title['between']?></h3>
		</div>
		<div class="panel-body">
			<?=GridView::widget([
				'id'=>'salesManAchievement',
				'tableOptions'=>['id'=>'salesManAchievementTbl'],
				'dataProvider'=>$resGrid['dataProvider'],
				'showPageSummary' => true,
				'columns'=>$resGrid['columns'],
			]);?>
		</div>
	</div>
	<?php
}