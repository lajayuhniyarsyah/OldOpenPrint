<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui;
use yii\web\View;
use app\models\ResPartner;
?>
<?php
$this->registerJs(
	"
	$('#formactivity').hide();
	$('#hideform').hide();

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

	"
	);
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
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<br/>
					<br/>
					<br/>
					<div id="formactivity">
						<?php 
						$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['site/dashboard'],
								]); 
					?>
						<div style="width:40%; float:left;">
							<?= $form->field($model, 'sales')->textInput() ?>
						</div>
						<div style="width:40%;float:right;">
							<?= $form->field($model, 'customer')->textInput() ?>
						</div>
						<div style="width:40%; float:left;">
							<?= $form->field($model, 'from')->textInput() ?>
						</div>
					<div style="clear:both"></div>
					<div class="form-group">
				         <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
				    </div>
					<?php ActiveForm::end(); ?>
					</div>
				</div>
					<table class="tabledashboard" border="1">
						<tr>
							<th width="30%" style="text-align:center;">Plan</th>
							<th width="70%" style="text-align:center;">Actual</th>
						</tr>
						
								<?php
									foreach ($activities as $value)
									{
										echo '<tr>';
											echo '<td valign="top" colspan="2" class="saleshead">';
												echo 
													'<table width="100%">
														<tr><td width="50%">'.strtoupper($value['sales_name']).'</td> <td  width="50%" align="right">'.Yii::$app->formatter->asDatetime($value['date'], "php:d-m-Y").'</td></tr>
													</table>';	
											echo '</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td valign="top">';
											$noplan=1;
											foreach ($value['activities']['plan'] as $plan) {
												echo 
													'<table>
														<tr><td width="20px" valign="top">'.$noplan.'.</td><td class="justify">'.$plan['name'].'</td></tr>
													</table>';
											$noplan++;
											}
											echo '</td>';
											
											// actual
											echo '<td valign="top">';
											$noactual=1;
											foreach ($value['activities']['actual'] as $b => $actual) {
												// echo  '<tr><td></td><td></td><td>'.$actual['name'].'</td></tr>';
												echo 
													'<table>
														<tr><td width="20px" valign="top">'.$noactual.'.</td><td class="justify">'.$actual['name'].'</td></tr>
													</table>';
											$noactual++;
											}
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