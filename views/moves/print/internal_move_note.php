<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<style type="text/css">
	body{
		font-size: 9pt;
	}
	table{
		/*border: 1px solid black;*/
		border-collapse: collapse;
	}
	thead{
	  display:table-header-group;/*repeat table headers on each page*/
	  height: 250px;
	  max-height: 251px;
	}
	tbody{
	  display:table-row-group;
	}
	tfoot{
	  display:table-footer-group;/*repeat table footers on each page*/
	}
	table tr td{
		vertical-align: top;
	}
	#tblMain{
		width: 600px;
		/*border: 1px solid black;*/
	}

	.tblHeader{
		width: 100%;
	}
	.title{
		font-size: 14pt;
		text-decoration: underline;
	}
	.title{
		padding-left: 100px;
	}
	.subtitle{
		padding-left:126px;
	}
	
	#tdHeaderLogo{
		width: 100px;
	}
	img#headerLogo{
		width: 100px;
	}

	.leftInfo{
		float: left;
		text-align: left;
		width: 280px;
	}
	.rightInfo{
		float: right;
		text-align: left;
		width: 250px;
	}

	#headerContent{
		width: 100%;
		border-bottom: 1px solid black;
		border-top: 1px solid black;
	}
	#tblFooter{
		width: 100%;
	}
	#footer1{
		width: 100%;
		border-top:1px solid black;
		line-height: 2em;
		margin-bottom: 20px;
	}

	#leftFooter1{
		width: 275px;
		float: left;
	}

	#rightFooter1{
		float: right;
	}

	#expeditionInfo{
		width: 300px;
	}

	#footer2{
		width: 100%;
		
		text-align: center;
	}
	#footer2 tr:first-child{
		height: 70px;
	}
	#tblLines{
		width: 100%;
		line-height: 23px;
	}

	.text-left{
		text-align: left;
	}
	.text-right{
		text-align: right;
	}


	.text-center{
		text-align: center;
	}

	.content1{
		width: 27px;
	}
	.content2{
		width: 54px;
	}
	.content3{
		width: 352px;
	}

	.expInfoHead{
		width: 110px;
	}
	.doubleDot{
		width: 4px;
	}

	.info1{
		width: 30px;
	}

	.info2{
		width: 9px;
	}
	.info3{
		width: 200px;
	}

	.noteContainer{
		padding-left: 7px;
		vertical-align: top;
		text-align: left;
	}
</style>
<table id="tblMain">
	<thead>
		<tr id="trHeader1">
			<th>
				<table class="tblHeader">

					<tr>
						<td id="tdHeaderLogo">
							<img id="headerLogo" src="img/logo.png" alt="Suprabakti Mandiri" />
						</td>
						<td style="text-align:left;">
							<div class="title">INTERNAL MOVE</div>
							<div class="subtitle"><?=$model->name?></div>
						</td>
					</tr>


				</table>

			</th>
		</tr>
		<tr id="trHeader2">
			<th>
				<div class="leftInfo">
					<table style="width:100%">
						<tr>
							<td class="info1">Dari</td>
							<td class="info2">:</td>
							<td class="info3"><?=Html::encode($model->source0->name)?></td>
						</tr>
						<tr>
							<td class="info1">Kepada</td>
							<td class="info2">:</td>
							<td class="info3"><?=Html::encode($model->destination0->name)?><br/><?=nl2br($model->destination0->comment)?></td>
						</tr>
					</table>
				</div>
				<div class="rightInfo">
					<table style="width:100%">
						<tr>
							<td class="info1">Tanggal</td>
							<td class="info2">:</td>
							<td class="info3"><?=Html::encode(Yii::$app->formatter->asDateTime($model->date_transfered,"php:d-M-Y"))?></td>
						</tr>
						<tr>
							<td class="info1R">No PB.</td>
							<td class="info2R">:</td>
							<!-- <td class="info3R"><?=Html::encode($model->internalMoveRequest->name.($model->manual_pb_no ? " | ".$model->manual_pb_no:""))?></td> -->
							<td class="info3R"><?=Html::encode($model->manual_pb_no)?></td>
						</tr>
					</table>
				</div>
				<div style="clear:both;" class="clear"></div>
			</th>
		</tr>
		
		<tr id="trHeader3">
			<td style="padding-top: 32px;">
				<table id="headerContent">
					<tr>
						<td class="content1 text-center">No.</td>
						<td class="content2 text-center">Qty</td>
						<td class="content3 text-center">Product/Description</td>
						<td class="content4 text-center">Part No.</td>
					</tr>
				</table>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<!-- content container -->
			<td>
				<table id="tblLines">
					<?php foreach($lines as $line): ?>
					<tr>
						<td contenteditable="true" class="content1 text-center"><?=$line['no']?></td>
						<td class="content2 text-center"><?=$line['qty']?></td>
						<td contenteditable="true" class="content3"><?=$line['product']?></td>
						<td contenteditable="true" class="content4 text-center"><?=$line['part_no']?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<!-- footer container -->
			<td>
				<table id="tblFooter">
					<tr>
						<td>
							<table id="footer1">
								<tr>
									<td id="leftFooter1">
										<div>
											<div>Catatan :</div>
											<div class="noteContainer">
												<?=nl2br($model->notes)?>
											</div>
										</div>
									</td>
									<?php
									$underLine = "_____________________";
									?>
									<td id="rightFooter1">
										<table id="expeditionInfo">
											<tr>
												<td class="expInfoHead">Jumlah Coli</td>
												<td class="doubleDot">:</td>
												<td class="expInfoVal"><?=Html::encode($underLine)?></td>
											</tr>
											<tr>
												<td>Dimensi</td>
												<td>:</td>
												<td><?=Html::encode($underLine)?></td>
											</tr>
											<tr>
												<td>Expedisi</td>
												<td>:</td>
												<td><?=Html::encode($underLine)?></td>
											</tr>
											<tr>
												<td>Tgl Pickup</td>
												<td>:</td>
												<td><?=Html::encode($underLine)?></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table id="footer2">
								<tr>
									<td>Penerima</td>
									<td>Pengirim</td>
									<td>Kepala Gudang</td>
									<td>Mengetahui</td>
								</tr>
								<?php $signDot = "(...........................)"; ?>
								<tr>
									<td><?=$signDot?></td>
									<td><?=$signDot?></td>
									<td><?=$signDot?></td>
									<td><?=$signDot?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tfoot>
	
</table>