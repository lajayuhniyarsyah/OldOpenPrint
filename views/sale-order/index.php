<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

use app\models\ResUsers;
use app\models\ResPartner;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SaleOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sale Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-order-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?=Html::beginForm(Url::canonical(),'get',[])?>
		<?=Html::textInput('page',null,['placeholder'=>'Go to Page','style'=>'width:80px;'])?>
		<?=Html::endForm()?>
	</p>
	<?php
	$url = \yii\helpers\Url::to(['sale-order/get-all-user-list']);

	// Script to initialize the selection based on the value of the select2 element
	$initScript = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}&id=" + id, {
				dataType: "json"
				}).done(function(data) { 
					callback(data.results);
				}
			);
		}
	}
SCRIPT;
	?>
	<?=GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'rowOptions'=>function($model,$key,$index,$grid){
			if($model->state=='cancel'){
				$style = 'color:red';
			}elseif($model->state == 'done'){
				$style = 'color:green;';
			}elseif($model->state == 'invoice_except'){
				$style = 'color:orange;';
			}
			else{
				$style='color:black;';
			}
			$res['style'] = $style;
			return $res;
		},
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			// 'id',
			[
				'attribute'=>'name',         
			],
			[
				'attribute'=>'create_uid',
				'value'=>function($model,$key,$index,$column){
					return $model->createU->partner->name;
				}
			],
			// 'create_date',
			// 'write_date',
			// 'write_uid',
			// 'origin',
			'client_order_ref',
			[
				'attribute'=>'user_id',
				'header'=>'Sales Man',
				'filterType'=>GridView::FILTER_SELECT2,
				// 'filter'=>\yii\helpers\ArrayHelper::map(ResUsers::find()->where('active is true')->with('partner')->all(),'id','name'),
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>3,
						'ajax'=>[
							'url'=>$url,
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression($initScript)
					],
				],
				'filterInputOptions' => ['placeholder' => 'Sales Man'],
				'value'=>function($model,$Key,$index,$column){
					return $model->user->partner->name;
				}
			],
			// 'order_policy',
			// 'shop_id',
			
			'date_order:date',
			[
				'attribute'=>'partner.name',
				'header'=>'Customer'
			],
			// 'note:ntext',
			// 'fiscal_position',
			
			// 'payment_term',
			// 'company_id',
			// 'amount_tax',
			[
				'attribute'=>'state',
				'value'=>function($model,$key,$index,$column){
					return $model->getStateAlias($model->state);
				},
				'filter'=>app\models\SaleOrder::getStateAliases()
			],
			// 'pricelist_id',
			// 'partner_invoice_id',
			// 'amount_untaxed',
			// 'date_confirm',
			// 'amount_total',
			// 'project_id',
			// 'name',
			// 'partner_shipping_id',
			// 'invoice_quantity',
			// 'picking_policy',
			// 'incoterm',
			[
				'attribute'=>'shipped',
				'format'=>'boolean',
				'filter'=>[
					'No','Yes'
				]
			],
			[
				'label'=>'OP',
				'value'=>function($model,$key,$index,$column){
					$res = '';
					foreach($model->orderPreparations as $op){
						if($res) $res.='<br/>';
						$res .= Html::a(Html::encode($op->name),'http://192.168.9.26:10001/?db=LIVE_2014&id='.$op->id.'&view_type=form&model=order.preparation&menu_id=546&action=498#id=14&view_type=form&model=order.preparation&menu_id=529&action=498',['class'=>'_blank']).' ('.$op->state.')';
					}
					return $res;
				},
				'format'=>'html',
				'options'=>['width'=>'300']
			],
			[
				'label'=>'DN',
				'value'=>function($model,$key,$index,$column){
					$res = '';
					foreach($model->deliveryNotes as $dn){
						if($res) $res.='<br/>';
						$res .= Html::a(Html::encode($dn->name),'http://192.168.9.26:10001/?db=LIVE_2014&id='.$dn->id.'&view_type=form&model=delivery.note&menu_id=527&action=502#id=1853&view_type=form&model=delivery.note&menu_id=527&action=502').' ('.$dn->state.')';
					}
					return $res;
				},
				'format'=>'html',
				'options'=>['width'=>'300']
			],

			[
				'label'=>'Invoices',
				'value'=>function($model,$key,$index,$column){
					$res = '';
					foreach($model->invoices as $inv){
						if($res) $res.='<br/>';
						$res .= Html::a(Html::encode($inv->name),'http://192.168.9.26:10001/?db=LIVE_2014&id='.$inv->id.'&view_type=form&model=account.invoice&menu_id=220&action=241').' ('.$inv->state.')';
					}
					return $res;
				},
				'format'=>'html',
				'options'=>['width'=>'300']
			],
			// 'carrier_id',
			// 'worktype',
			// 'delivery_date',
			// 'week',
			// 'attention_moved0',
			// 'attention',
			// 'internal_notes:ntext',
			// 'due_date',

			[
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{view}',
				'buttons'=>[
					'view'=>function($url,$model,$key){
						if($model->state=='draft' || $model->state=='cancel'){
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','http://192.168.9.26:10001/?db=LIVE_2014&debug=#id='.$model->id.'&view_type=form&model=sale.order&menu_id=255&action=305');
						}else{
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','http://192.168.9.26:10001/?db=LIVE_2014&debug=#id='.$model->id.'&view_type=form&model=sale.order&menu_id=254&action=302');
						}
						
					}
				]

			],
		],
	]); ?>

</div>
