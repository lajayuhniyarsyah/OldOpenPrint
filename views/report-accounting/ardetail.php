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
use app\models\ResPartner;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use miloschuman\highcharts\Highcharts;
?>
<?php
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

?>
<div class="oe_view_manager oe_view_manager_current">
	<div class="oe_view_manager_header">
		<h3 class="judul">
			Accounting Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">AGED RECEIVABLES DETAIL</div>
					<a data-pjax="0" title="Reset AR Detail" href="<?php echo \yii\helpers\Url::to(['report-accounting/ardetail']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>
					<br/>
					<br/>
				</div>
			<div style="clear:both"></div>
				<div id="ardetail">
					<?php
						$form = ActiveForm::begin([
						'id'=>'ArDetailForm',
						'action'=>[''],
						'options' => [
									'target' => '_blank'
									]
									,
						'method'=>'get',
					]);
					?>
					<?php
						echo $form->field($model, 'partner')->widget(Select2::classname(), [
							'options' => ['placeholder' => 'All Customer ...'],
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
					<br/>
					<?=DatePicker::widget([
						'model' => $model,
						'attribute' => 'date_from',
						'options' => ['placeholder' => 'Start date'],
					
						'form' => $form,
						'pluginOptions' => [
							'format' => 'yyyy-MM-dd',
							// 'format' => 'dd-MM-yyyy',
							'autoclose' => true,
							'startDate'=>'01/07/2014',
						],
						'convertFormat'=>true,
					]);?>
					<div class="form-group">
					    <br/>
					    <?= Html::submitButton('Search', ['class' =>'btn btn-primary']) ?>
					</div>
					<?php ActiveForm::end(); ?>
					</div>

			<div style="clear:both"></div>
		</div>

	</div>
</div>