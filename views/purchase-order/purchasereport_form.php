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
use app\models\PurchaseOrderLine;
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
		 $('.'+nilai).toggle();

	});

	"
	);

$url = \yii\helpers\Url::to(['supplierlist']);
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

?> 
<div class="oe_view_manager oe_view_manager_current">
	<div class="oe_view_manager_header">
		<h3 class="judul">
			Purchase Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">PURCHASE REPORT</div>
					<br/>
					<br/>
					<!-- <div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					    Group Data
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo \yii\helpers\Url::to(['purchase-order/purchasereportbysupplier']); ?>">Group By Supplier</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo \yii\helpers\Url::to(['purchase-order/purchasereportbystate']); ?>">Group By State</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo \yii\helpers\Url::to(['purchase-order/purchasereportbyproduct']); ?>">Group By Product</a></li>
					  </ul>
					</div> -->
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<a data-pjax="0" title="Reset AR Detail" href="<?php echo \yii\helpers\Url::to(['purchase-order/purchasereport']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>

					<br/>
					<br/>
					<div id="formactivity">
						<?php 
						$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['purchase-order/purchasereportsearch'],
								]); 
					?>
						<div style="width:40%;float:left;">
							<?php
								echo $form->field($model, 'partner_id')->widget(Select2::classname(), [
									'options' => ['placeholder' => 'All Supplier ...'],
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
								echo $form->field($modelline, 'product_id')->widget(Select2::classname(), [
									'options' => ['placeholder' => 'All Product ...'],
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
						<div style="width:100%;">
							<div style="float:left; width:45%;">
									<?=DatePicker::widget([
										'model' => $model,
										'attribute' => 'date_order',
										'attribute2' => 'duedate',
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
								 echo $form->field($model, 'state')
								    ->dropDownList(
								          [
								          	'all'=>'All Status',
								          	'draft' => 'Draft', 
											'confirmed' => 'Confirmed',
											'approved' => 'Approved',
											'done' => 'Done',
											'cancel' => 'Cancel'
								          ]
								        )->label('');      
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

			<?php 
				if($type=="default")
				{ 
			?>
			<table class="ReportTable" border="1" width="100%">
				<thead>
						<tr class="head line40">
							<th class="head line40">No</th>
							<th class="head line40">Supplier</th>
							<th class="head line40">Date</th>
							<th class="head line40">Product</th>
							<th class="head line40">Price Unit</th>
							<th class="head line40">State</th>
						</tr>
					</thead>

				<?php
					$no=1;
					foreach ($data as  $value) {
						echo '<tr>
									<td>'.$no.'</td>
									<td>'.$value['partner'].'</td>
									<td>'.Yii::$app->formatter->asDatetime($value['date_order'], "php:d-m-Y").'</td>
									<td>'.$value['product'].'</td>
									<td align="right">'.app\components\NumericLib::indoStyle($value['price_unit'],2,',','.').'</td>
									<td>'.$value['state'].'</td>
							 <tr>';
						$no++;
					}
				?>
			</table>
			<?php } ?>
			<?php 
				if($type=="bysupplier")
				{
				?>
						<table class="tableactivity ReportTable" border="1">
							<tr id="allshow" class="pointer">
								<tr class="head line40">
								<th class="head line40">No</th>
								<th class="head line40">Supplier</th>
								<th class="head line40">Date</th>
								<th class="head line40">Product</th>
								<th class="head line40">Price Unit</th>
								<th class="head line40">State</th>
							</tr>
				<?php
				foreach ($data as $value)
				{
				echo '<tr class="headactivity"  id='.$value['partner_id'].'>';
					echo '<td valign="top" colspan="8" class="saleshead">';
						echo 
							'<table width="100%">
								<tr>
									<td width="50%">';
								echo '<div class="salesname">'
										.strtoupper($value['name']).'
									</div>
									</td> 
								</tr>
							</table>';	
					echo '</td>';
				echo '</tr>';
				$no=1;
				foreach ($value['purchaseline']['detail'] as $detail) 
					{
					echo '<tr class="detailactivity plan detail_'.$value['partner_id'].'" id="detail_'.$value['partner_id'].'_'.$no.'">';
							echo '<td>'.$no.'</td>';
							echo '<td valign="top" class="plan">';
									echo $detail['partner'];
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo $detail['date_order'];
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo ucwords($detail['product']);
							echo '</td>';
							echo '<td valign="top" class="plan" align="right">';
									echo app\components\NumericLib::indoStyle($detail['price_unit'],0,',','.');
							echo '</td>';
							echo '<td valign="top" class="plan" align="center">';
									echo $detail['state'];
							echo '</td>';
					echo '</tr>';	
					$no++;
					}
				}
				?>
					</table>
			<?php
				}
			?>

			<?php
				if($type=="search"){
			?>
				<table class="ReportTable" border="1" width="100%">
				<thead>
						<tr class="head line40">
							<th class="head line40">No</th>
							<th class="head line40">Supplier</th>
							<th class="head line40">PO</th>
							<th class="head line40">Date</th>
							<th class="head line40">Product</th>	
							<th class="head line40">Qty</th>
							<th class="head line40">Price Unit</th>
							<th class="head line40">Total</th>
							<th class="head line40">Currency</th>
							<th class="head line40">State</th>
						</tr>
					</thead>

				<?php
					$no=1;
					$total=0;
					$qty=0;
					$grandtotal=0;
					foreach ($data as  $value) {
						echo '<tr>
									<td>'.$no.'</td>
									<td>'.$value['partner'].'</td>
									<td>'.$value['no_po'].'</td>
									<td>'.Yii::$app->formatter->asDatetime($value['date_order'], "php:d-m-Y").'</td>
									<td>'.$value['product'].'</td>
									<td class="alignrigth">'.app\components\NumericLib::indoStyle($value['product_qty'],2,',','.').'</td>
									<td align="right" class="alignrigth">'.app\components\NumericLib::indoStyle($value['price_unit'],2,',','.').'</td>
									<td align="right" class="alignrigth">'.app\components\NumericLib::indoStyle($value['price_unit']*$value['product_qty'],2,',','.').'</td>
									<td>'.$value['pricelist'].'</td>
									<td>'.$value['state'].'</td>
							 <tr>';
						$total=$total+$value['price_unit'];
						$qty=$qty+$value['product_qty'];
						$grandtotal=$grandtotal+($value['price_unit']*$value['product_qty']);
						$no++;
					}
				?>
				<tr class="head line40">
							<th class="head line40" colspan="5">Grand Total</th>
							<th class="head line40"><?php echo app\components\NumericLib::indoStyle($qty,2,',','.'); ?></th>
							<th class="head line40"></th>
							<th class="head line40"><?php echo app\components\NumericLib::indoStyle($grandtotal,2,',','.'); ?></th>
							<th class="head line40" colspan="2"></th>
						</tr>
			</table>
			<?php
				}
			?>
			<div style="clear:both"></div>
		</div>

	</div>
</div>