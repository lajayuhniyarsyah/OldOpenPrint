<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\helpers\Url;

use yii\web\JsExpression;

use miloschuman\highcharts\Highcharts;

\miloschuman\highcharts\HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-invoice-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Dahsboard</h3>
		</div>
		<div class="panel-body">
			<?=
			HighCharts::widget([
				'options'=>[
					'chart'=>[
						'type'=>'column',
					],
					'title'=>['text'=>'Invoice Payment Status Composition'],
					
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
							'name'=>"Payment Status",
							"data"=>$pie['series'],
							/*"data"=>[
								[
									'name'=>'Tes 1',
									'y'=>rand(0,100),
									'drilldown'=>'drill1'
								],
								[
									'name'=>'Tes 2',
									'y'=>rand(0,100),
									'drilldown'=>'drill2'
								],
								[
									'name'=>'Tes 3',
									'y'=>rand(0,100),
									'drilldown'=>'drill3'
								]

							]*/
						]
					],
					'drilldown'=>[
						'series'=>$pie['drilldown']
					]
					/*'drilldown'=>[
						'series'=>[
							[
								'id'=>'drill1',
								'data'=>[
									['Tes 1 1',rand(0,100)],
									['Tes 1 2',rand(0,100)],
									['Tes 1 3',rand(0,100)],
								]
							],
							[
								'id'=>'drill2',
								'data'=>[
									['Tes 2 1',rand(0,100)],
									['Tes 2 2',rand(0,100)],
									['Tes 2 3',rand(0,100)],
								]
							],
							[
								'id'=>'drill3',
								'data'=>[
									['Tes 3 1',rand(0,100)],
									['Tes 3 2',rand(0,100)],
									['Tes 3 3',rand(0,100)],
								]
							],
						]
					]*/
				]
			])
			?>
		</div>
	</div>

	<?= GridView::widget([
		'id'=>'invoiceGrid',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'showPageSummary'=>true,
		'columns' => [
			['class' => 'kartik\grid\SerialColumn'],

			'kwitansi',
			[
				'attribute'=>'partner_id',
				'value'=>function($model,$key,$index,$row){
					return $model->partner->name;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>2,
						'ajax'=>[
							'url'=>Url::to(['service/search-customer']),
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression(
								'function (element, callback) {
								var id=$(element).val();
								if (id !== "") {
									$.ajax("'.Url::to(['service/search-customer']).'&id=" + id, {
										dataType: "json"
										}).done(function(data) {
											callback(data.results);
										}
									);
								}
							}')
						],
				],
			],
			// 'id',
			
			/*'write_date',
			'write_uid',*/
			// 'origin',
			// 'date_due',
			// 'check_total',
			// 'reference',
			// 'supplier_invoice_number',
			// 'number',
			// 'account_id',
			// 'company_id',
			
			// 'name',
			// 'comment:ntext',
			// 'sent:boolean',
			// 'commercial_partner_id',
			// 'kmk',
			// 'faktur_pajak_no',
			
			// 'pajak',
			// 'kurs',
			// 'approver',
			[
				'attribute'=>'type',
				'value'=>function($model,$key,$index,$grid){
					$arr = ['in_invoice'=>'Supplier Invoice','out_invoice'=>'Customer Invoice','in_refund'=>'Supplier Refund','out_refund'=>'Customer Refund'];
					return $arr[$model->type];
				},
				'filter'=>['in_invoice'=>'Supplier Invoice','out_invoice'=>'Customer Invoice','in_refund'=>'Supplier Refund','out_refund'=>'Customer Refund'],
			],
			
			[
				'attribute'=>'user_id',
				'value'=>function($model,$key,$index,$grid){
					return $model->user->partner->name;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>2,
						'ajax'=>[
							'url'=>Url::to(['service/search-user']),
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression(
								'function (element, callback) {
								var id=$(element).val();
								if (id !== "") {
									$.ajax("'.Url::to(['service/search-user']).'&id=" + id, {
										dataType: "json"
										}).done(function(data) {
											callback(data.results);
										}
									);
								}
							}')
						],
				],
			],
			'create_date:datetime',
			[
				'attribute'=>'date_invoice',
				'format'=>'datetime',
				'filterType'=>GridView::FILTER_DATE_RANGE,
				'filterWidgetOptions'=>[
					'presetDropdown'=>true,
					'convertFormat'=>true,
					'pluginOptions'=>[
						'format' => 'yy-m-d',
						'separator'=>' To ',
						'opens'=>'left'
					],
					'pluginEvents'=>[
						'apply.daterangepicker'=>"function(){
							jQuery('#invoiceGrid').yiiGridView('applyFilter');
							console.log('called');
						}"
					]
				]
			],

			[
				'attribute'=>'currency_id',
				'value'=>function($model,$key,$index,$grid){
					return $model->currency->name;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>2,
						'ajax'=>[
							'url'=>Url::to(['service/search-currency']),
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression(
								'function (element, callback) {
								var id=$(element).val();
								if (id !== "") {
									$.ajax("'.Url::to(['service/search-currency']).'&id=" + id, {
										dataType: "json"
										}).done(function(data) {
											callback(data.results);
										}
									);
								}
							}')
						],
				],
			],
			[
				'attribute'=>'currency_id',
				'value'=>function($model,$key,$index,$grid){
					return $model->currency->name;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>2,
						'ajax'=>[
							'url'=>Url::to(['service/search-currency']),
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression(
								'function (element, callback) {
								var id=$(element).val();
								if (id !== "") {
									$.ajax("'.Url::to(['service/search-currency']).'&id=" + id, {
										dataType: "json"
										}).done(function(data) {
											callback(data.results);
										}
									);
								}
							}')
						],
				],
			],
			// 'fiscal_position',
			// 'user_id',
			// 'partner_bank_id',
			// 'payment_term',
			// 'reference_type',
			// 'journal_id',
			// 'amount_tax',
			
			
			// 'internal_number',
			// 'reconciled:boolean',
			// 'residual',
			// 'move_name',
			// 'date_invoice',
			// 'period_id',
			// 'move_id',
			[
				'attribute'=>'amount_total',
				'format'=>'decimal',
				'filter'=>false,
			],
			[
				'attribute'=>'currency_rate',
				'format'=>'currency',
			],
			[
				'attribute'=>'total_rated',
				'format'=>'currency',
				'pageSummary'=>true,
			],
			[
				'attribute'=>'state',
				'value'=>function($model,$key,$index,$grid){
					$arr = ["draft"=>"Draft","proforma"=>"Pro-forma","proforma2"=>"Pro-forma","open"=>"Open","paid"=>"Paid","cancel"=>"Cancelled"];
					return $arr[$model->state];
				},
				'filter'=>["draft"=>"Draft","proforma"=>"Pro-forma","proforma2"=>"Pro-forma","open"=>"Open","paid"=>"Paid","cancel"=>"Cancelled"],
			],
			[
				'class' => 'kartik\grid\ActionColumn',
				'template'=>'{view}',
				'buttons'=>[
					'view'=>function($url,$model,$key){
						$url = 'http://192.168.9.26:10001/?db=LIVE_2014#id='.$model->id.'&view_type=form&model=account.invoice&menu_id=220&action=241';
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url);
						
						
					}
				]

			],
		],
	]); ?>

</div>
