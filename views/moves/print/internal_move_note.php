<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<style type="text/css">
	table{
		/*border: 1px solid black;*/
		border-collapse: collapse;
	}
	table tr td{
		vertical-align: top;
	}
	#tblMain{
		width: 1000px;
		/*border: 1px solid black;*/
	}

	.tblHeader{
		width: 100%;
	}
	h1.title{
		text-decoration: underline;
	}
	#tdHeaderLogo{
		width: 230px;
	}
	img#headerLogo{
		width: 200px;
	}

	.leftInfo{
		float: left;
		text-align: left;
	}
	.rightInfo{
		float: right;
		text-align: left;
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
		line-height: 28px;
	}

	#leftFooter1{
		width: 450px;
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
		margin-top: 80px;
		text-align: center;
	}
	#footer2 tr:first-child{
		height: 130px;
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
		width: 47px;
	}
	.content2{
		width: 107px;
	}
	.content3{
		width: 474px;
	}

	.expInfoHead{
		width: 110px;
	}
	.doubleDot{
		width: 4px;
	}

	.info1{
		width: 90px;
	}

	.info2{
		width: 9px;
	}
	.info3{
		width: 262px;
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
						<td>
							<h1 class="title">INTERNAL MOVE</h1>
							<h4><?=$model->name?></h4>
						</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr id="trHeader2">
			<th>
				<div class="leftInfo">
					<table>
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
					<table>
						<tr>
							<td class="info1">Tanggal</td>
							<td class="info2">:</td>
							<td class="info3"><?=Html::encode(date('d-m-Y'))?></td>
						</tr>
						<tr>
							<td class="info1">No PB.</td>
							<td class="info2">:</td>
							<td class="info3"><?=Html::encode($model->internalMoveRequest->name.($model->manual_pb_no ? " | ".$model->manual_pb_no:""))?></td>
						</tr>
					</table>
				</div>
			</th>
		</tr>
		<tr id="trHeader3">
			<td style="padding-top: 52px;">
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
											<div>
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