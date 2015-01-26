<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui;
use app\models\ResPartner;
?>
<div class="oe_view_manager oe_view_manager_current">
	<div class="oe_view_manager_header">
		<h3 class="judul">Sales Activity Report</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<!-- <img style="width:250px; float:left" src="<?= Url::base() ?>/img/report/sales_activity.jpg"> -->
				<?php 
					$form = ActiveForm::begin([
								'method'=>'get',
								'action'=>['site/reportactivity'],
							]); 
				?>

					<?= $form->field($model, 'type')->textInput() ?>
					<div style="width:40%; float:left;">
						<?= $form->field($model, 'sales')->textInput() ?>
					</div>
					<div style="width:40%;float:right;">
						<?= $form->field($model, 'customer')->textInput() ?>
					</div>
					<div style="width:40%; float:left;">
						<?= $form->field($model, 'from')->textInput() ?>
					</div>
					<div style="width:40%;float:right;">
						<?= $form->field($model, 'to')->textInput() ?>
					</div>
				<div style="clear:both"></div>
				<div class="form-group">
			         <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
			    </div>
				<?php ActiveForm::end(); ?>
			</div>

			<div class="viewreport">

			</div>
		</div>
	</div>
</div>