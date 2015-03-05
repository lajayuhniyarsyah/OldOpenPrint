<?php
use yii\helpers\Url;
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
use kartik\widgets\Growl;
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
		<!-- <h3 class="judul">
			welcome To Management Report
		</h3> -->
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">REPORT SALES ACTIVITY</div>
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<a data-pjax="0" title="Reset Activity" href="<?php echo \yii\helpers\Url::to(['site/activity']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>
					<br/>
					<br/>
					<br/>
					<div id="formactivity">
						<?php 
						$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['site/activity'],
								]); 
					?>
						<div style="width:40%; float:left;">

							<?php
								echo $form->field($model, 'sales')->widget(Select2::classname(), [
									'options' => [
											'placeholder' => 'Search for a Sales ...',
											'multiple' => true,
											],
									'pluginOptions' => [
										'tags'=>true,
										'allowClear' => true,
										'minimumInputLength' => 3,
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
								echo $form->field($model, 'customer')->widget(Select2::classname(), [
									'options' => [
										'placeholder' => 'Search for a Customer ...',
										],
									'pluginOptions' => [
										'allowClear' => true,
										'minimumInputLength' => 3,
										'ajax' => [
											'url' => $urlcus,
											'dataType' => 'json',
											'data' => new JsExpression('function(term,page) { return {search:term}; }'),
											'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
										],
										'initSelection' => new JsExpression($initScriptcus)
									],
								]);
							?>
						</div>
						<div style="width:40%; float:left;">
							<?php
								echo '<label>Date From</label>';
								echo DatePicker::widget([
									'attribute' => 'from',
									'model'=>$model,
									'value' => date('d-m-Y', strtotime('+2 days')),
									'options' => ['placeholder' => 'Select issue date ...'],
									'pluginOptions' => [
									'format' => 'dd-mm-yyyy',
									'todayHighlight' => true
									]
								]);
							?>	
						</div>
						<div style="width:40%;float:right;">
							<?php
								echo '<label>Date To</label>';
								echo DatePicker::widget([
									'attribute' => 'to',
									'model'=>$model,
									'value' => date('d-m-Y', strtotime('+2 days')),
									'options' => ['placeholder' => 'Select issue date ...'],
									'pluginOptions' => [
									'format' => 'dd-mm-yyyy',
									'todayHighlight' => true
									]
								]);
							?>	
						</div>

					<div style="clear:both"></div>
					<div class="form-group">
						<br/><br/>
				         <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
				    </div>
					<?php ActiveForm::end(); ?>
					</div>
				</div>	
					<table class="tabledashboard" border="1">
						<tr id="allshow" class="pointer">
							<th width="50%" style="text-align:center;">Plan</th>
							<th width="50%" style="text-align:center;">Actual</th>
						</tr>
						
								<?php
									foreach ($activities as $value)
									{
										echo '<tr class="headactivity" id='.$value['sales_name'].'>';
											echo '<td valign="top" colspan="2" class="saleshead">';
												echo 
													'<table width="100%">
														<tr><td width="50%"><div class="salesname">'.strtoupper($value['sales_name']).'</div></td> <td  width="50%" align="right"><div class="salesname">'.Yii::$app->formatter->asDatetime($value['date'], "php:d-m-Y").'</div></td></tr>
													</table>';	
											echo '</td>';
										echo '</tr>';
										echo '<tr class="detailactivity plan" id="detail_'.$value['sales_name'].'">';
											echo '<td valign="top" class="plan">';
												echo '<div class="plan details">';
												echo '<strong>Detail Plan</strong>';
												echo '<table class="plan tabledetail">';
													$noplan=1;
													foreach ($value['activities']['plan'] as $plan) 
													{
														echo 
															'<tr class="plan">
																	<td width="2%" valign="top" class="plan"> <center>* </center></td>';
																	$customer = ResPartner::find('name')
																			    ->where(['id' => $plan['partner_id']])
																			    ->one();
																	echo'<td width="20%" class="plan">'.$customer['name'].'</td>';    		
																	echo'<td width="78%" class="justify plan">'.nl2br(ucfirst($plan['name'])).'</td>
																</tr>';
													$noplan++;
													}
												echo '</table>';
												echo '</div>';
											echo '</td>';
											// actual
											echo '<td valign="top plan">';
											echo '<div class="plan details">';
											echo '<strong>Detail Actual</strong>';
											$noactual=1;
											echo '<table class="plan tabledetail">';
											foreach ($value['activities']['actual'] as $b => $actual) {
												echo '<tr class="plan">
															<td width="2%" valign="top" class="plan"> <center>* </center></td>';
															$customer = ResPartner::find('name')
																->where(['id' => $actual['partner_id']])
																->one();
														echo'<td width="20%" class="plan">'.$customer['name'].'</td>';  
														echo '<td width="78%" class="justify plan">'.nl2br(ucfirst($actual['name'])).'</td>
														</tr>';
													
											$noactual++;
											}
											echo '</table>';
											echo '</div>';
											echo '<td>';
									echo '</tr>';	
									}
									?>
					</table>

				</div>

			<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>