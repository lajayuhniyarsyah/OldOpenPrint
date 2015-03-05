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
use app\models\ResUsers;
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
					<div class="subjudul">REPORT WEEKLY STATUS</div>
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<a data-pjax="0" title="Reset Activity" href="<?php echo \yii\helpers\Url::to(['site/weeklystatus']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>
					<br/>
					<br/>
					<br/>
					<div id="formactivity">
						<?php 
						$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['site/weeklystatus'],
								]); 
					?>
						<div style="width:40%; float:left;">

							<?php
								echo $form->field($model, 'sales')->widget(Select2::classname(), [
									'options' => ['placeholder' => 'Search for a Sales ...'],
									'pluginOptions' => [
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
						 echo $form->field($model, 'productgroup')
						    ->dropDownList(
						          [
			          				'all'=>'All Product Category',
			          				'Pekerjaan dan Barang' => 'Pekerjaan dan Barang',
									'Pekerjaan' => 'Pekerjaan',
									'ABB' => 'ABB',  
									'Rema TipTop' => 'Rema TipTop',
									'Almex Vulcanizer' => 'Almex Vulcanizer',
									'SuperScrew by Minet' => 'SuperScrew by Minet',
									'UHMW' => 'UHMW',
									'Etec - Ceremic Lining' => 'Etec - Ceremic Lining',
									'Ringfeder' => 'Ringfeder',
									'Ohji Rubber' => 'Ohji Rubber',  
									'R/L Karet Lokal' => 'R/L Karet Lokal',
									'Loctite' => 'Loctite', 
									'MBX Bristle Blaster' => 'MBX Bristle Blaster',
									'3LT' => '3LT', 
									'RTT Lining' => 'RTT Lining',
									'AMP - Roady' => 'AMP - Roady',
									'YIFAN - Crusher' => 'YIFAN - Crusher',
									'Tehnoroll / Ecoroll' => 'Tehnoroll / Ecoroll',
									'Tehnopulley' => 'Tehnopulley',
									'rulmeca' => 'Rulmeca', 
									'Lorbrand' => 'Lorbrand',
									'Voith' => 'Voith', 
									'Trelleborg Marine System : Mining & Pelindo' => 'Trelleborg Marine System : Mining & Pelindo',
									'martin' => 'Martin',
									'TruTrac' => 'TruTrac', 
									'Mc Lanahan' => 'Mc Lanahan', 
									'Grinding Ball' => 'Grinding Ball',
									'GoodYear' => 'GoodYear',
									'Rocktrans' => 'Rocktrans',
									'HKM : Magnet separator / Metal Detector' => 'HKM : Magnet separator / Metal Detector',
									'ECP : Safety Device' => 'ECP : Safety Device',
									'Stacker Reclaimer - MTI' => 'Stacker Reclaimer - MTI',
									'Trelleborg Marine System : Oil & Gas'=> 'Trelleborg Marine System : Oil & Gas',
									'Belt Conveyor' => 'Belt Conveyor',
									'Roller & Pulley' => 'Roller & Pulley'
						          ]
						        )->label('');      
						?>

						</div>
						<div style="width:40%; float:right;">
						<?php
						 echo $form->field($model, 'status')
						    ->dropDownList(
						          [
						          	'all'=>'All Status',
						          	'nego' => 'Negoisasi', 
									'quo' => 'Quotation',
									'post' => 'Postpone',
									'win' => 'Win',
									'lost' => 'Lost'
						          ]
						        )->label('');      
						?>
					</div>
					<div style="clear:both"></div>
					<div class="form-group">
						<br/><br/>
				         <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
				    </div>
					<?php ActiveForm::end(); ?>
					</div>

					<table class="tableactivity" border="1">
						<tr id="allshow" class="pointer">
							<th style="text-align:center;" width="19%">Customer</th>
							<th style="text-align:center;" width="10%">Quotation</th>
							<th style="text-align:center;" width="10%">Product</th>
							<th style="text-align:center;" width="6%">Project</th>
							<th style="text-align:center;" width="6%">Currency</th>
							<th style="text-align:center;" width="8%">Amount</th>
							<th style="text-align:center;" width="35%">Last Status</th>
							<th style="text-align:center;" width="6%">Status</th>
						</tr>
						
			<?php
				foreach ($data as $value)
				{
				echo '<tr class="headactivity"  id='.$value['sales_name'].'>';
					echo '<td valign="top" colspan="8" class="saleshead">';
						echo 
							'<table width="100%">
								<tr>
									<td width="50%">';
									$customer = ResUsers::find('name')
															->where(['id' => $value['sales_name']])
															->one();
								echo '<div class="salesname">'
										.strtoupper($customer['name']).'
									</div>
									</td> 
									<td  width="50%" align="right"></td>
								</tr>
							</table>';	
					echo '</td>';
				echo '</tr>';
				foreach ($value['liststatus']['project'] as $project) 
					{
					echo '<tr class="detailactivity plan" id="detail_'.$value['sales_name'].'">';
							echo '<td valign="top" class="plan">';
									echo $project['customer'];
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo $project['sales_order'];
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo ucwords($project['productgorup']);
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo $project['project'];
							echo '</td>';
							echo '<td valign="top" class="plan" align="center">';
									echo $project['currency'];
							echo '</td>';
							echo '<td valign="top" class="plan" align="right">';
									echo app\components\NumericLib::indoStyle($project['total'],0,',','.');
							echo '</td>';
							echo '<td valign="top" class="plan">';
									echo '<div style="text-align:justify">'.nl2br($project['status'].'</div>');
							echo '</td>';
							echo '<td valign="top" class="plan" align="center">';
									if($project['state']=="quo"){
										echo 'Quotation';
									}else if($project['state']=="nego"){
										echo 'Negoisasi';
									}else if($project['state']=="post"){
										echo 'Postpone';
									}else if($project['state']=="win"){
										echo 'WIN';
									}else if($project['state']=="lost"){
										echo 'LOST';
									}
							echo '</td>';
					echo '</tr>';	
					}
				}
				?>
					</table>
				</div>	

			<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>