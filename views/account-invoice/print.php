<?php
// use Setup;
?>

<!-- <header id="pageHeader" style="background:red;height:40mm;">
	Header
</header> -->
<style type="text/css">
	body{
		
		padding-top: 5%;
		padding-left: 3%;
		letter-spacing: 6px;
	}
	.main{
		/*background: blue;*/
		height:25cm;
		width: 100%;

	}
	.header{
		/*background: red;*/
		height:32%;
		/*background: red;*/
	}
	.content{
		height: 32%;
		/*border-bottom: 1px solid;*/
	}
	.footer{
		height: 20%;
		/*background: red;*/
	}
	#yii-debug-toolbar-min{display: none;}
	.hidden-print{display: none !important;}
	.kwitansiNo{
		margin-bottom: 5px;
	}
	.noPajak{
		margin-left: 29%;
		margin-bottom: 2%;
	}
	.pkp{
		margin-bottom: 3%;
	}
	
	.itemRow:after{
		
	}
	.itemNo{
		width: 2%;
		/*float: left;*/
	}
	.itemName{
		/*width: 12%; float: left;*/
	}
	.itemPrice{
		width: 6%;
		background: red;
		/*width: 12%; float: left;*/
	}
	.itemNo:before{
		clear: both;
	}
	.pads{
		padding-left: 20%;
	}
	.lineFoot{
		padding-left: 74%;
	}
	.lineFoot div{
		/*margin-bottom: 1%;*/
		/*border: 1px solid black;*/
	}
	.mrgBtm1{
		margin-bottom: 1%;
	}
	.sign{
		margin-top: 4%;
		padding-left: 58%;
	}
	.sign .signName{
		margin-top: 24%;
		margin-left: 9%;
	}
</style>

<?php
$pages=1;
?>
<div class="main<?=$pages?>">
	<div class="header">
		<div class="kwitansiNo">Inv. <?= $model->kwitansi ?></div>
		<div class="noPajak"><?= $model->faktur_pajak_no; ?></div>
		<div class="pkp">
			<div class="pads mrgBtm1">PT. SUPRABAKTI MANDIRI</div>
			<div class="pads mrgBtm1"><span>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</span></div>
			<div class="pads mrgBtm1">01.327.742.1-038.000</div>
		</div>
		<div class="pbkp">
			<div class="pads mrgBtm1"><?= $model->partner->name; ?></div>
			<div class="pads mrgBtm1"><span><?= $model->partner->street; ?> <?= $model->partner->street2 ?> <?= $model->partner->city ?> <?= $model->partner->zip ?></span></div>
			<div class="pads mrgBtm1"><span><?= ($model->partner->npwp ? $model->partner->npwp:'-'); ?></span></div>
		</div>
	</div>
	<div class="content">
		<table id="contentTable" width="100%">
			<tbody>
			<?php foreach($model->accountInvoiceLines as $invoiceLine): ?>
				<tr>
					<td width="6%"><?= $invoiceLine->sequence ?></td>
					<td><?php if(isset($invoiceLine->product)) : ?>[<?= $invoiceLine->product->default_code ?>]<?php endif; ?> <?= $invoiceLine->name ?></td>
					<td width="26%"><?= $invoiceLine->price_subtotal ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</div>
	<div class="footer">
		<div class="lineFoot">
			<div class="pads2 height3">
				<?= $model->amount_untaxed; ?>
			</div>
			<div class="height3">
				&nbsp;
			</div>
			<div class="height3">
				&nbsp;
			</div>
			<div class="height3">
				<?= (isset($model->amount_untaxed) ? $model->amount_untaxed:''); ?>
			</div>
			<div class="height3">
				<?= (isset($model->amount_tax) ? $model->amount_tax:''); ?>
			</div>
		</div>
		<div class="sign">
			<div class="tgl">Jakarta <span style="margin-left:30%;"><?= Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-m-Y"); ?></span></div>
			<div class="signName"><?= strtoupper($model->approver0->partner->name); ?></div>
		</div>
	</div>
</div>


<?php
$this->registerJs('
	console.log(jQuery(\'.main1\').height());
');
?>