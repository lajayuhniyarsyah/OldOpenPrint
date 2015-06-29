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
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\bootstrap\Dropdown;

use app\models\PurchaseOrderLine;
use app\models\ResPartner;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use miloschuman\highcharts\Highcharts;
use nirvana\infinitescroll\InfiniteScrollPager;
use kartik\grid\GridView;

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
		 $('.'+nilai).toggle();

	});

	"
	);

$url = \yii\helpers\Url::to(['customerlist']);
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

$urlproduct = \yii\helpers\Url::to(['productlist']);
$initScriptProduct = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;

$urlcategory = \yii\helpers\Url::to(['productcategory']);
$initScriptCategory = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;


$urlpricelist = \yii\helpers\Url::to(['productpricelist']);
$initScriptpricelist = <<< SCRIPT
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
			Sales Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">SALES REPORT</div>
					<br/>
					<br/>
					<div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					    Group Data
					    <span class="caret"></span>
					  </button>
					  <?php
					  		$currQParam = Yii::$app->request->getQueryParams();
					  		$action = $currQParam['r'];
					  		unset($currQParam['r']);
					  		$base = [$action];
					  		$baseQ = array_merge($base,$currQParam);
					  		$toCustomer = array_merge($baseQ,['groupBy'=>'customer']);
					  	?>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					  		<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo \yii\helpers\Url::to(array_merge($baseQ,['groupBy'=>'category'])); ?>">Group By Product Category</a></li>
					  </ul>
					</div> 
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<a data-pjax="0" title="Reset Sales Product Report" href="<?php echo \yii\helpers\Url::to(['sale-order/productsales']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>
					<br/>
					<br/>

					<div id="formactivity">
						<?php

						if($groupBy=='nogroup'){
							$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['sale-order/productsales'],
								]); 
						}else{
							$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['sale-order/productsales','groupBy'=>'category'],
								]); 
						}
					?>
						
						<div style="width:40%;float:left;">
							<?php
								echo $form->field($model, 'product')->widget(Select2::classname(), [
									'options' => ['placeholder' => 'All Product ...'],
									'value'=>Yii::$app->request->get('product'),
									'pluginOptions' => [
										'tags'=>true,
										'allowClear' => true,
										'minimumInputLength' => 2,
										'ajax' => [
											'url' => $urlproduct,
											'dataType' => 'json',
											'data' => new JsExpression('function(term,page) { return {search:term}; }'),
											'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
										],
										'initSelection' => new JsExpression($initScriptProduct)
									],
								]);
							?>
						</div>
						<div style="width:40%;float:right;">
							<?php
								echo $form->field($model, 'productcategory')->widget(Select2::classname(), [
									'data' => $datacetegory,
									'value'=>Yii::$app->request->get('productcategory'),
									'options' => [
										'placeholder' => 'Select Product Category ...',
										'multiple' => true,
									]

								]);
							?>
						</div>

						<div style="width:40%;float:left;">
							<?php
								echo $form->field($model, 'partner')->widget(Select2::classname(), [
									'options' => ['placeholder' => 'All Customer ...'],
									'value'=>Yii::$app->request->get('product'),
									'pluginOptions' => [
										'tags'=>true,
										'allowClear' => true,
										'minimumInputLength' => 2,
										'ajax' => [
											'url' => $url,
											'dataType' => 'json',
											'data' => new JsExpression('function(term,page) { return {search:term}; }'),
											'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
										],
										'initSelection' => new JsExpression($initScript)
									],
								]);
							?>
						</div>

						<div style="width:40%;float:right;">

							<?php
								echo $form->field($model, 'pricelist')->widget(Select2::classname(), [
									'data' => $datapricelist,
									'value'=>Yii::$app->request->get('pricelist'),
									'options' => [
										'placeholder' => 'Select Pricelist ...',
										'multiple' => true,
									]

								]);
							?>
						</div>

						<div style="width:100%;">
							<div style="float:left; width:45%;">
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
							</div>
							<div style="width:40%;float:right; line-height:0px">

							<?php
								echo $form->field($model, 'state')->widget(Select2::classname(), [
								    'name' => 'state', 
								    'options' => ['placeholder' => 'Select a State ...'],
								    'pluginOptions' => [
								        'tags' => ["draft", "confirmed", "approved", "done", "cancel"],
								        'maximumInputLength' => 10
								    ],
								]);
							?>
							</div>
						</div>

					<div style="clear:both"></div>
					<div class="form-group">
						<br/><br/>
				         <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
				    </div>
					<?php ActiveForm::end(); ?>
					</div>
				</div>
			<div style="clear:both"></div>

			<?php if($type=="default") {  ?>

			<div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Report Product Sales</h3>
	            </div>
		            <div class="panel-body">
		                <?php
		                if($groupBy==null){
		                	 echo GridView::widget([
			                    'id'=>'prospectGrid',
			                    'dataProvider'=>$dataProvider,
			                    'showPageSummary'=>true,
			                    'columns'=>[
			                        [
			                            'class'=>'kartik\grid\ExpandRowColumn',
			                            'width'=>'50px',
			                            'value'=>function ($model, $key, $index, $column) {
			                                return GridView::ROW_COLLAPSED;
			                            },
			                            'detailUrl'=>\yii\helpers\Url::to(['#']),
			                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
			                        ],
			                        'partner',
			                        'category',
			                        'product',
			                        [
			                        	'attribute'=>'qty',
			                            'header'=>'Qty',
			                            'value'=>function($model,$key,$index,$grid){
			                                return app\components\NumericLib::indoStyle($model['qty'],2,',','.');
			                            }
			                        ],
			                        [
			                        	'attribute'=>'price_unit',
			                            'header'=>'Currency',
			                            'value'=>function($model,$key,$index,$grid){
			                                return app\components\NumericLib::indoStyle($model['price_unit'],2,',','.');
			                            }
			                        ],
			                        [
			                            'attribute'=>'cout',
			                            'header'=>'Count',
			                            'value'=>function($model,$key,$index,$grid){
			                            	return 0;
			                            }
			                        ],
			                        'pricelist',
			                        'state',
			                        
			                    ]
			                ]);
		                }else{
		                	 echo GridView::widget([
			                    'id'=>'prospectGrid',
			                    'dataProvider'=>$dataProvider,
			                    'showPageSummary'=>true,
			                    'columns'=>[
			                        [
			                            'class'=>'kartik\grid\ExpandRowColumn',
			                            'width'=>'50px',
			                            'value'=>function ($model, $key, $index, $column) {
			                                return GridView::ROW_COLLAPSED;
			                            },
			                            'detailUrl'=>\yii\helpers\Url::to(['#']),
			                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
			                        ],
			                        'category',
			                        [
			                            'attribute'=>'cout',
			                            'header'=>'Count',
			                            'value'=>function($model,$key,$index,$grid){
			                            	// return 0;
			                                return app\components\NumericLib::indoStyle($model['total'],2,',','.');
			                            }
			                        ],
			                        'pricelist',
			                        
			                    ]
			                ]);
		                }
		               
		                ?>

		            </div>
        	</div>
			<?php }else if($type=="search"){  ?>

			<div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Report Product Sales</h3>
	            </div>
		            <div class="panel-body">
		                <?php
		                	if($groupBy=='nogroup'){
		                ?>
		                <?=GridView::widget([
		                    'id'=>'prospectGrid',
		                    'dataProvider'=>$dataProvider,
		                    'showPageSummary'=>true,
		                    'columns'=>[
		                        [
		                            'class'=>'kartik\grid\ExpandRowColumn',
		                            'width'=>'50px',
		                            'value'=>function ($model, $key, $index, $column) {
		                                return GridView::ROW_COLLAPSED;
		                            },
		                            'detailUrl'=>\yii\helpers\Url::to(['#']),
		                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
		                        ],
		                        'partner',
		                        'so_no',
		                        'category',
		                        'product',
		                        [
		                        	'attribute'=>'qty',
		                            'header'=>'Qty',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['qty'],2,',','.');
		                            }
		                        ],
		                        [
		                        	'attribute'=>'price_unit',
		                            'header'=>'Currency',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['price_unit'],2,',','.');
		                            }
		                        ],
		                        'pricelist',
		                        [
		                            'attribute'=>'cout',
		                            'header'=>'Count',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['total'],2,',','.');
		                            }
		                        ],
		                        'state'
		                    ]
		                ])?>

		                <?php  }else{ ?>

		                	<?=GridView::widget([
		                    'id'=>'prospectGrid',
		                    'dataProvider'=>$dataProvider,
		                    'showPageSummary'=>true,
		                    'columns'=>[
		                        [
		                            'class'=>'kartik\grid\ExpandRowColumn',
		                            'width'=>'50px',
		                            'value'=>function ($model, $key, $index, $column) {
		                                return GridView::ROW_COLLAPSED;
		                            },
		                            'detailUrl'=>\yii\helpers\Url::to(['sale-order/detail-grid']),
		                            'headerOptions'=>['class'=>'kartik-sheet-style'] 
		                        ],
		                        'category',
		                        'pricelist',
		                        [
		                            'attribute'=>'cout',
		                            'header'=>'Count',
		                            'value'=>function($model,$key,$index,$grid){
		                                return app\components\NumericLib::indoStyle($model['total'],2,',','.');
		                            }
		                        ]
		                    ]
		                ])?>
		                <?php } ?>
		            </div>
        	</div>
			<?php }?>

		</div>

    </div>
	</div>
</div>