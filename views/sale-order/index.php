<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
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

	$url2 = \yii\helpers\Url::to(['sale-order/get-all-creator-list']);

	// Script to initialize the selection based on the value of the select2 element

	$script = function($uri){
		return 'function (element, callback) {
			var id=$(element).val();
			if (id !== "") {
				$.ajax("'.$uri.'&id=" + id, {
					dataType: "json"
					}).done(function(data) { 
						callback(data.results);
					}
				);
			}
		}';
	}
	?>
	<?php Pjax::begin(['id'=>'pjax-so-grid']); ?>
	<?=GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax'=>true,
		'tableOptions'=>[
			'style'=>'width:1500px;max-width:1500px;'
		],
		'pager' => [
			'firstPageLabel' => 'First',
			'lastPageLabel' => 'Last',
		],
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
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength'=>2,
						'ajax'=>[
							'url'=>$url2,
							'dataType'=>'json',
							'data'=>new JsExpression('function(term,page){return {search:term}; }'),
							'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
						],
						'initSelection' => new JsExpression($script($url2))
					],
				],
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
						'initSelection' => new JsExpression($script($url))
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
			/*[
				'attribute'=>'shipped',
				'format'=>'boolean',
				'filter'=>[
					'No','Yes'
				]
			],*/
			[
				'attribute'=>'amount_total',
				'value'=>function($model,$key,$index,$column){
					return Yii::$app->numericLib->indoStyle($model->amount_total);
				}
			],
			[
				'attribute'=>'pricelist_id',
				'label'=>'SO Currency',
				'value'=>function($model,$key,$index,$column){
					return $model->pricelist->name;
				},
				'filter'=>\yii\helpers\ArrayHelper::map(app\models\ProductPricelist::find()->all(),'id','name')
			],
			[
				'label'=>'OP',
				'value'=>function($model,$key,$index,$column){
					$res = '';
					foreach($model->orderPreparations as $op){
						if($res) $res.='<br/>';
						$res .= Html::a(Html::encode($op->name),'http://192.168.9.26:10001/?db=LIVE_2014#id='.$op->id.'&view_type=form&model=order.preparation&menu_id=529&action=498',['class'=>'_blank']).' ('.$op->state.')';
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
						$res .= Html::a(Html::encode($dn->name),'http://192.168.9.26:10001/?db=LIVE_2014#id='.$dn->id.'&view_type=form&model=delivery.note&menu_id=527&action=502').' ('.$dn->state.')';
					}
					return $res;
				},
				'format'=>'html',
				'options'=>['width'=>'300']
			],
			[
				'label'=>'Invoices',
				'format'=>'',
				'value'=>function($model,$key,$index,$column){
					$res = '<ul class="list-group">';
					foreach($model->invoices as $inv){
						// if($res) $res.='<br/>';
						$val = $inv->currency->name.' '.Yii::$app->formatter->asDecimal($inv->amount_total);
						$validCurrency = ($model->pricelist->currency_id == $inv->currency_id ? true:false);
						switch ($validCurrency) {
							case false:
								$res .= '<li class="list-group-item">'.
									Html::a(
										Html::decode(
											'<span class="bg-danger">'.$inv->name.' - '.$val.' ('.$inv->state.')</span>'
										),
										'http://192.168.9.26:10001/?db=LIVE_2014#id='.$inv->id.'&view_type=form&model=account.invoice&menu_id=220&action=241').
									'</li>';
								break;
							
							default:
								$res .= '<li class="list-group-item">'.
									Html::a(
										Html::decode(
											$inv->name.' - '.$val.' ('.$inv->state.')'
										),
										'http://192.168.9.26:10001/?db=LIVE_2014#id='.$inv->id.'&view_type=form&model=account.invoice&menu_id=220&action=241').
									'</li>';
								break;
						}
						
					}
					$res .= '<ul>';
					return $res;
				},
				'format'=>'html',
				'options'=>['width'=>'400px']
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
				'template'=>'{view}{done}',
				'buttons'=>[
					'view'=>function($url,$model,$key){
						if($model->state=='draft' || $model->state=='cancel'){
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','http://192.168.9.26:10001/?db=LIVE_2014&debug=#id='.$model->id.'&view_type=form&model=sale.order&menu_id=255&action=305');
						}else{
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','http://192.168.9.26:10001/?db=LIVE_2014&debug=#id='.$model->id.'&view_type=form&model=sale.order&menu_id=254&action=302');
						}
						
					},
					'done'=>function($url,$model,$key){
						if(!Yii::$app->user->isGuest){
							if($model->state != 'done' && $model->state != 'cancel' && $model->state != 'draft'){
								return Html::a(
									'<span class="glyphicon glyphicon-check"></span>',
									[
										'sale-order/to-done',
										'id'=>$model->id
									],
									[
										'onclick'=>new JsExpression('
											jQuery.ajax({
												url:jQuery(this).attr(\'href\')
											}).success(function(res){
												$.pjax.reload({container:\'#pjax-so-grid\'});
											}).error(function(res){
												alert(\'Error\');
											});
											return false;
										'),
									]
								);
							}
							
						}else{
							return null;
						}
					}
				]

			],
		],
	]); ?>
	<?php Pjax::end(); ?>

</div>
