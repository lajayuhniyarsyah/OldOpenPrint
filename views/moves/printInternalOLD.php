<?php
use yii\helpers\Url;
?>
<style type="text/css">
	#yii-debug-toolbar-minn{
		display: none !imprtant;
	}
	body{
		margin-bottom: 10% !important;
		/* letter-spacing: 6px; */
	}
	table{
		border-collapse: collapse;
	}
	table tbody tr td{
		vertical-align: top;
		text-align: left;
		padding-left: 3px;
		padding-top:3px;
		padding-bottom: 2px;
	}

	table thead tr th{
		text-align: center
	}
	/* table#contentVal thead tr th{
		border: 1px solid black;
	} */
	table#contentVal{
		min-height: 200px;
	}
	table#contentVal tbody tr td{
		border-bottom:1px white solid;
	}
	table#contentVal tr td{
		padding: 4px;
	}


	#heading{
		/*letter-spacing: 1pt;*/
	}
	#heading span{
		display: block;
		text-align: center;
	}

	.border{
		border:1px solid black;
	}
	.border-left{
		border-left: 1px solid black;
	}
	.border-right{
		border-right: 1px solid black;
	}

	.fontLitle{
		font: 8pt solid black;
	}
	.bold{
		font-weight: bold;
	}
	.boldBig{
		font: 17pt black;
		font-weight: bold;
	}
	.addrBar{
		height: 100px;
		padding-left:3px;
		padding-top:3px;
		border: 1px solid black;
	}


</style>
<table id="tblMain" width="100%">
	<thead>
		<tr>
			<th>
				<table width="100%">
					<tr>
						<td width="13%">
							<img style="width:100%;" src="<?= Url::base() ?>/img/logo.png">
							<div style="font: 5pt solid black;text-align:center;">SBM-F-PCH-02/01<br/>12/01/30</div>
						</td>
						<td>
							<div id="heading">
								<span class="boldBig">PT. SUPRABAKTI MANDIRI</span>
								<span class="fontLitle">Jl.Danau Sunter UtaraBlok A No.9 Sunter Jakarta Utara 14350-INDONESIA</span>
								<span class="fontLitle">Telephone : +62 21 658 33666, Fax : +62 21 658 31666</span>
								<div style="height:20px;">&nbsp;</div>
								<span class="boldBig">INTERNAL MOVES</span>
							</div>
						</td>
						<td style="vertical-align:bottom;">
							<?=strtoupper($user->initial)?>
						</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<th>
				<table cellpadding="0" cellspacing="0" border="1px" width="100%">
					<tr>
						<td width="50%">
							<table>
								<tr>
									<td width="10%">To</td>
									<td>:</td>
									<td>
									<?=$partner->name?><br/>
									<?=$partner->comment?></td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<td style="width:61%;">IM NO</td>
									<td>:</td>
									<td><?=$model->name?></td>
								</tr>
								<tr>
									<td>Reference</td>
									<td width="3px">:</td>
									<td><?=$model->origin?></td>
								</tr>
								<tr>
									<td>Delivery Date</td>
									<td>:</td>
									<td>
										<?=Yii::$app->formatter->asDatetime($model->min_date, "php:d-m-Y");?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td >
				<table id="contentVal" cellpadding="0" cellspacing="0" border="1px" width="100%">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th style="width:12%;">QTY</th>
							<th>PART NAME</th>
							<th>PART NUMBER</th>
						</tr>
					</thead>
					<tbody>
					<?php $move_set_printed = [];$countLines = count($model->stockMoves); ?>
					<?php foreach($model->stockMoves as $k=>$move): ?>
						
							<?php
							// JIKA MOVE SET DATA TIDAK ADA DAN BELUM ADA YG DI PRINTED STOCK MOVE REF DARI MOVE SET DATA
							if(isset($move->set) && !isset($move_set_printed[$move->set_id])):
							?>
								<tr>
									<td class="border-left"><?= $move->set->no ?></td>
									<td class="border-left">
										<?=$move->set->product_qty.' '.$move->set->productUom->name?>O
									</td>
									<td class="border-left">
										<?=$move->set->product->name_template?>
										<div>
											Consist Of :
											<ul id="listConsistOf<?=$move->set_id?>"></ul>
										</div>

									</td>
									<td class="border-left border-right"><?=$move->set->product->default_code?></td>
									<?php $move_set_printed[$move->set_id][] = $move->id; ?>
								</tr>
							<?php
							elseif(!isset($move_set_printed[$move->set_id])):
							?>
								<tr>
									<td style="<?php if($countLines==1 || ($countLines>1 and $countLines<4 and ($k+1)==$countLines)): echo 'height:'.(200-($countLines*30)).'px;'; endif; ?>" class="border-left">
										<?= $move->no ?>
										
									</td>
									<td class="border-left"><?=$move->product_qty.' '.$move->productUom->name?></td>
									<td class="border-left"><?=($move->name ? nl2br($move->name):nl2br($move->desc))?></td>
									<td class="border-left border-right"><?=$move->product->default_code?></td>
								</tr>
							<?php
							elseif(isset($move_set_printed[$move->set_id])):
								$move_set_printed[$move->set_id][] = $move->id;
							endif;
							?>
						
					<?php endforeach;?>

						<tr>
							<td colspan="4" style="padding:0!important;">
								<?php //var_dump($move_set_printed); ?>
								<div>
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td style="height:100px;width:60%;border-top:1px solid black !important;border-bottom:1px solid !important;" colspan="3"><?=$model->note ?></td>
											<td class="border-left" style="border-top:1px solid black !important;border-bottom:1px solid !important;">
												<div style="height:50px;">
													<span>Ekspedisi : </span>
												</div>
												<div style="height:50px;">
													<span>Jumlah Coli : </span>
												</div>
											</td>
										</tr>
									</table>
									<table width="100%">
										<tr>
											<td style="height:80px;text-align:center;">Penerima</td>
											<td class="border-left" style="text-align:center;">Pengirim</td>
											<td class="border-left" style="text-align:center;">Kepala Gudang</td>
											<td class="border-left" style="text-align:center;">Mengetahui</td>
										</tr>
										<tr>
											<td style="text-align:center;">(.................)</td>
											<td class="border-left" style="text-align:center;">(.................)</td>
											<td class="border-left" style="text-align:center;">(.................)</td>
											<td class="border-left" style="text-align:center;">(.................)</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td style="border-top:2px solid black !important;border-left:1px solid white;background:white;border-right:1px solid white;border-bottom:1px solid white;" colspan="4">
								<!-- <hr style="margin-top:-17px;"/> -->&nbsp;
								<!-- <div style="border-top:1px solid black;">&nbsp;</div> -->
							</td>
						</tr>
					</tfoot>
					
				</table>
			</td>
		</tr>
	</tbody>

	<!-- <tfoot>
		<tr>
			<td>
				<div>
					<table border="1px" width="100%">
						<tr>
							<td style="height:100px;width:60%;" colspan="3"><?=$model->note ?>Untuk Supply Mesin Almex</td>
							<td>
								<div style="height:50px;">
									<span>Ekspedisi : </span>
								</div>
								<div style="height:50px;">
									<span>Jumlah Coli : </span>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</tfoot> -->
	
</table>


<?php
// var_dump($move_set_printed);
foreach($move_set_printed as $set=>$childs):
	$consist[$set] = [];
	$setTo = '';
	foreach($childs as $child):
		$moveChild = app\models\StockMove::findOne($child);
		// echo $moveChild->product->name_template;
		$setTo .='<li>['.$moveChild->product->default_code.'] '.$moveChild->product->name_template.' ('.$moveChild->product_qty.' '.$moveChild->productUom->name.')</li>';
	endforeach;
	$scr = '
		jQuery(\'#listConsistOf'.$set.'\').html(\''.$setTo.'\')
	';
	$this->registerJs($scr,yii\web\View::POS_END);
endforeach;

?>