<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style type="text/css">

	#kwitansiContainer{
		margin-top:0px;
		margin-left: 234px;
		width: 600px;
		height: 450px;
		/*border: 1px solid black;*/
		padding-top: 110px;
		font-size: 18px;
	}
	#invNo{
		text-align: right;

	}
	.widPO{
		width: 376px;
		float: left;
	}
	.clearBoth{
		clear: both;
	}
	.absPos{
		position: absolute;
	}
	#custName{
		font-weight: bold;
		margin-top:68px;
		font-size: 17px;
	}
	#address{
		margin-top: 95px;
		font-size: 13px;
		font-size: 16px;
	}
	#words{
		font-style: italic;
		line-height: 38px;
    	margin-top: 142px;
    	
	}
	#paymentOf1{
		margin-top: 258px;
	}

	#paymentOf2{
		margin-top: 300px;
	}

	#paymentOf3{
		margin-top: 340px;
	}
	.widPO{
		float: left;
		width: 455px;
	}
	.widPOCurr{
		width: 50px;
		float: left;
	}
	.widPOVal{
		float: left;
		width: 94px;
		text-align: right;
	}
	.plusSign{
		float: left;
		margin-top: 10px;
		margin-left: 7px;

	}

	#subtotal{
		margin-top: 470px
	}
	#date{
		margin-top: 424px;
		margin-left: 450px;
	}
	#sign{
		margin-top: 613px;
		margin-left: 380px;
		font-weight: bold;
		font-size: 16px;
	}

	#hrTotal{
		width: 603px;
		margin-top: 320px;
	}
	#hrTotal hr{
		border-color: black;
	}
	.big{
		font-size: 21px;
		font-weight: bold;
	}
	.choosePrinter{
		position: absolute;
		z-index: 9999;
		right: 0;
	}

	<?php
	if($printer=='sri'):;
	?>

		#kwitansiContainer{
			margin-top:0px;
			margin-left: 234px;
			width: 600px;
			height: 450px;
			/*border: 1px solid black;*/
			padding-top: 82px;
			font-size: 18px;
		}
	<?php
	endif;
	?>

	@media print{
		.choosePrinter{
			display: none;
		}
	}
</style>
<?php
$this->registerAssetBUndle('\yii\web\JqueryAsset');
$formated = function($value) use ($model){
		if($model->currency_id==13){
			return Yii::$app->numericLib->indoStyle(floatval($value));
		}else{
			return Yii::$app->numericLib->westStyle(floatval($value));
		}
	};

?>

<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
			<input type="hidden" value="<?=Url::to('account-invoice/print-kwitansi')?>" name="r" />
			<input type="hidden" value="<?=$model->id?>" name="id" />
			<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : <select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
		</select>
	</form>
</div>
<div id="kwitansiContainer">
	<div id="invNo"><?=$model->kwitansi?></div>
	<div id="custName" class="absPos">
		<?=$model->partner_to_print?>
	</div>
	<div id="address" class="absPos">
		<?=$model->partner->street.', '.$model->partner->street2.' '.$model->partner->city.', '.(isset($model->partner->state->name) ? $model->partner->state->name:'').($model->partner->zip ? ' - '.$model->partner->zip:"")?>
	</div>
	<div id="words" class="absPos" contenteditable="true">
		#<?=ucwords(Yii::$app->numericLib->convertToWords($model->amount_total,$model->currency->name))?>#
	</div>
	<div id="paymentOf1" class="absPos">
		<div class="widPO" contenteditable="true">Sesuai Faktur Pajak No. <?=$model->faktur_pajak_no?></div>
		<div class="widPOCurr"><?=$model->currency->name?></div>
		<div class="widPOVal"><?=$formated($model->amount_untaxed)?></div>
		<div class="clearBoth"></div>
	</div>
	<div id="paymentOf2" class="absPos">
		<?php 
			$taxes = $model->accountInvoiceTaxes;
			foreach($taxes as $tax){
				echo '<div class="widPO">'.$tax->name.'</div><div class="widPOCurr">'.$model->currency->name.'</div><div class="widPOVal">'.$formated($tax->amount).'</div>';
			}
		?>
		
	</div>
	<div id="paymentOf3" class="absPos">
		<div class="widPO">Jumlah</div>
		<div class="widPOCurr"><?=$model->currency->name?></div>
		<div class="widPOVal"><?=$formated($model->amount_total)?></div>
		
	</div>
	<div id="hrTotal" class="absPos" >
		<hr size="3" noshade="1" />
		
	</div>
	<div id="subtotal" class="absPos">
		<div class="big widPOCurr"><?=$model->currency->name?></div><div class="big widPOVal" style="width:140px;"><?=$formated($model->amount_total)?></div>
	</div>
	<div id="date" class="absPos">
		<?=date('d-m-Y',strtotime($model->date_invoice))?>
	</div>
	<div id="sign" class="absPos">
		<?=strtoupper($model->approver0->partner->name)?>
	</div>
</div>