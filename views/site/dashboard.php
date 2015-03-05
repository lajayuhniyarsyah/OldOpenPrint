<?php
use yii\helpers\Url;
use yii\db\connection;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\jui;
use yii\web\View;
use yii\db\Command;
use yii\db\Query;
use app\models\ResPartner;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use miloschuman\highcharts\Highcharts;
?>
<?php
$this->registerJs(
	"
	$('#formactivity').hide();
	$('#hideform').hide();
	$('.detailactivity').hide();

	$('#allshow').click(function(){
		$('.detailactivity').toggle();
	});
	$('#showform').click(function(){
		$('#formactivity').fadeIn();
		$('#showform').hide();
		$('#hideform').show();
	});

	$('#hideform').click(function(){
		$('#formactivity').fadeOut();
		$('#showform').show();
		$('#hideform').hide();
	});
	
	$('.headactivity').click(function(){
		 val=$(this).attr('id');
		 nilai='detail_'+val;
		 $('#'+nilai).toggle();

	});

	"
	);

$url = \yii\helpers\Url::to(['userlist']);
$initScript = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;

$urlcus = \yii\helpers\Url::to(['partnerlist']);
$initScriptcus = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;
 ?>  

<div class="oe_view_manager oe_view_manager_current">
	<div class="oe_view_manager_header">
		<h3 class="judul">
			welcome To Management Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">DASHBOARD</div>
					<a data-pjax="0" title="Reset Activity" href="<?php echo \yii\helpers\Url::to(['site/dashboard']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>
				
				</div>

			<div style="clear:both"></div>
			<div style="width:50%; float:left">
				<?php
				echo Highcharts::widget([
				   'options' => [
				   	  'chart' => ['type' => 'column'],
				      'title' => ['text' => 'Report Weekly Status'],
				      'subtitle' => ['text' => 'Weekly Status'],
				      'xAxis' => [
				         'categories'=> [
						                'Jan',
						                'Feb',
						                'Mar',
						                'Apr',
						                'May',
						                'Jun',
						                'Jul',
						                'Aug',
						                'Sep',
						                'Oct',
						                'Nov',
						                'Dec'
						            ]
				      ],
				      'yAxis' => [
				      	 'min' => 0,
				         'title' => ['text' => 'Total Project']
				      ],
					  'tooltip' => [
					  	'headerFormat' =>'<span style="font-size:10px">{point.key}</span><table>',
					  	'footerFormat' => '</table>',
					  	'shared' => true,
					  	'useHTML' => true,
					  ],

					  'plotOptions' => [
					  	'column' => [
					  		'pointPadding' =>0.2,
					  		'borderWidth' => 0
					  	]
					  ],
				      'series' => [
				         [
				         	'name' => 'Tokyo', 
				         	'data' => [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
				         ],
				         [
				         	'name' => 'New York', 
				         	'data' => [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
				         ],
				         [
				         	'name' => 'London', 
				         	'data' => [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
				         ],
				         [
				         	'name' => 'Berlin', 
				         	'data' => [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
				         ]

				      ]
				   ]
				]);
			?>
			</div>
			<div style="width:50%; float:left;">
				<?php
				echo HighCharts::widget([
					'options'=>[
						'title'=>['text'=>'Report Sales Project'],
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
								'name'=>"Qty Project",
								'data'=>[
									[
										'name'=>"A",
										'y'=>1000
									],
									[
										'name'=>"B",
										'y'=>900
									],
									[
										'name'=>"C",
										'y'=>100
									],
								],
							]
						]
					]
				]);
			?>
			</div>

				<div style="clear:both"></div>
		</div>

	</div>
</div>