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
		<h3 class="judul">
			welcome To Management Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:40%; float:left;">
					<?php
					echo '<pre>';
					var_dump($plan);
					echo '</pre>';
					foreach ($plan as $obj =>$dataplan)
					{
						// var_dump($dataplan);
						foreach ($dataplan as $key=>$value){
							foreach ($value as $keys => $val) {
								$sales=$val['login'];
								$data[]=$val['partner'];
								$data[]=$val['loc'];
								$data[]=$val['name'];
								// echo $val['name'].'<br/>';
							}
						}
						/*echo $sales.'<br/>';

						foreach($data as $datas){
							echo $datas.'<br/>';
						}*/

						/*echo '<pre>';
							print_r($data);
						echo '</pre>';*/
					}
					?>
				</div>
				<div style="width:40%;float:right;">
					<?php
					foreach ($actual as $obj =>$dataplan)
					{
						foreach ($dataplan['data'] as $key=>$value){
							/*echo '<pre>';
							var_dump($value);*/
						}
					// echo "<br>";
					}
					?>
				</div>
			<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>