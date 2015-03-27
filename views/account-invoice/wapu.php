<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\helpers\Url;

use yii\web\JsExpression;

?>


<?php
$this->title = 'Account Invoice - WAPU';
?>
<div class="account-invoice-wapu">
	<h1>Invoices - WAPU</h1>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Dahsboard</h3>
		</div>
		<div class="panel-body">
			<?=GridView::widget([
				'id'=>'invoice-wapu-grid',
				'dataProvider'=>$dataProvider,
				'columns'=>[
					'number',
					'name',
					'kwitansi',
					'origin',
					'faktur_pajak_no',
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
					'amount_total',
				]
			])?>
		</div>
	</div>
</div>