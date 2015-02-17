<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\helpers\Url;

use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-invoice-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Account Invoice', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

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
			[
				'attribute'=>'amount_untaxed',
				'format'=>'decimal',
				'filter'=>false,
			],
			// 'move_id',
			[
				'attribute'=>'amount_total',
				'format'=>'decimal',
				'filter'=>false,
			],
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
				'attribute'=>'state',
				'value'=>function($model,$key,$index,$grid){
					$arr = ["draft"=>"Draft","proforma"=>"Pro-forma","proforma2"=>"Pro-forma","open"=>"Open","paid"=>"Paid","cancel"=>"Cancelled"];
					return $arr[$model->state];
				},
				'filter'=>["draft"=>"Draft","proforma"=>"Pro-forma","proforma2"=>"Pro-forma","open"=>"Open","paid"=>"Paid","cancel"=>"Cancelled"],
			],
			[
				'attribute'=>'create_uid',
				'value'=>function($model,$key,$index,$grid){
					return $model->createU->partner->name;
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
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{view}',
			],
		],
	]); ?>

</div>
