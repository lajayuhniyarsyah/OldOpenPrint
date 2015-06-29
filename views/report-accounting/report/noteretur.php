<?php
use yii\helpers\Url;


?>
<style type="text/css">
	#pageContainer{
		width: 200mm;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
		font-family: Arial, Helvetica, sans-serif;
	}
	table{
		/* border-top: 1px solid black;
		border-bottom: 1px solid black; */
	}
	.contener{
		border: 1px solid black;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
		font-family: Arial, Helvetica, sans-serif;
	}
	.header{
		height: 10%;
	}
	.content{
		height: 80%;
	}

	.pages{
		page-break-after: always;
	}

		.logo{
		width: 140mm;
		
		float: left;
	}
	.logo img{
		margin-top:10px;
		margin-left: 10px;
		display: block;
	}
	.logo .judul{
		font-size: 24px;
		margin-top: -60px;
		margin-left: 15px;
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-weight: bold;
		float: left;
		letter-spacing: 1px;
	}
	.iso{
		margin-top:10px;
		float: right;
		width: 50mm;
	}
	.do{
		font-size: 24px;
		font-weight: bold;
		margin-left: 16px;
		margin-top: 0px;
		/*position: absolute;*/
		/*font-family: Times New Roman;*/
		float: left;
		text-decoration: underline;
	}
	.yth{
		display: block;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 14px;
		margin-left: 16px;
		margin-top: 12px;
		width: 50%;
	}
	.customer{
		float: right;
		width: 40%;
		display: block;
		margin-right: 10px;
		margin-top: -23px;
	}
	fieldset{
		width: 271px;
		height: 95px;
		display: block;
	    margin-left: 2px;
	    margin-right: 2px;
	    margin-top:5px;
	    border: none;
	    background-image: url(<?= Url::base() ?>/img/square.png);
	    background-size: 350px;
	}
	.headtable{
		margin-left: 15px;
		margin-top: 5px;
	}
	.isicus{
		display: block;
		font-size: 12px;
		margin-left: 10px;
		margin-top: 22px;
	}
	.content{
		margin-left: 15px;
		margin-top: 15px;
		 margin-right:20px;
	}
	.content table .headtable{
		border-collapse: collapse
	}
	.headtablepages tr th{
		border: 1px solid black;
		/*font-family: Times New Roman;*/
		font-size: 13px;
		line-height: 20px;
		text-align: center;
	}
	.foodtablepages tr th{
		border: 1px solid black;
		/*font-family: Times New Roman;*/
		font-size: 13px;
		padding-left: 30px;
		line-height: 20px;
		text-align: left;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:430px; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
	}
	.tablefooter td{
		border: medium none !important;
		/*font-family: Times New Roman;*/
		font-size: 11px;
		text-align: center;
	}
	.isigudang{
		margin-top:35px;
		margin-left: 40px;
		text-align: left;
		font-weight: bold;
		/*font-family: Times New Roman;*/
	}
	.gudang{
		margin-left: 40px;
		border: none;
		/*font-family: Times New Roman;*/
	}
	.gudang td{
		line-height: 30px;
		border: none !important;
		font-size: 12px;

	}
	.data{
		position: absolute;
		border-collapse: collapse;
		border: none !important; 
		max-height: 300px;
	}
	.data td{
		border: none !important; 
		font-size: 18px;

	}
	.tablecontent{
		font-size: 13px;
   		 line-height: 20px;
		/*font-family: Times New Roman;*/
	}
	@media all {
		.page-break	{ display: none; }
	}
	@media print {
		.page-break	{ display: block; page-break-before: always; }
		.break{
			height:1mm !important;
		}
		.tglkirim{
			width: 203px !important;
		}
/*		.tablettd{
			margin-top: -48px !important;
		}	*/
		/*.tblkirim{
		margin-top: -13px !important;
		}*/
	/*	.isigudang{
			margin-top: -10px;
		}*/

	}
	.pages{
		height: 245mm;
		padding-left:4mm;
		page-break-after: always;
	}
	.contentLines{
		border-collapse: collapse;
		width: 186mm;
		margin-top: -9px;
		border-bottom:  1px solid black;
	}
	.contentLines tbody tr td {
		border-left:  1px solid black;
		border-right:  1px solid black;
		border-collapse: collapse;
		line-height: 25px;
		font-size: 12px;
		vertical-align: top;
	}
	.leftdata{
		float: left;
		width: 75%;
		margin-left: 10px;
	}
	.rightdata{
		width: 18%;
		float: right;
		margin-right: 10px;
		text-align: right;
	}
	.tglkirim{
		width: 203px;
	}
	.break{
		height:100mm;
	}
	.tablettd{
		width:400px; float:left;  margin-left: 15px;margin-top: -9px;
	}
	.tblkirim{
		border-collapse: collapse;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 12px;
		line-height: 30px;
		margin-left: 15px;
		margin-top: -1px;
	}
	.dataiso{
		text-align: center;
		width: 100px;
		float: left;
		font-size: 9px;
		margin-left: 2px;
	}
	.nota{
		text-align: center;
		display: block;
		font-size: 24px;
		font-weight: bold;
		border-bottom: 1px solid black;
	}
	.line{
		border:1px solid black;
		margin-top: -1px;
	}
</style>
<div id="pageContainer">

<?php

	foreach ($model->accountInvoiceLines as $value) {
		// echo $value['product_id'];
		$data2[]=array(
						''.$value['sequence'].'',
						''.$value['name'].'',
						''.app\components\NumericLib::indoStyle($value['quantity'],2,',','.').' '.$value->uos->name.'',
						''.app\components\NumericLib::indoStyle($value['price_unit'],2,',','.').'',
						''.app\components\NumericLib::indoStyle($value['quantity']*$value['price_unit'],2,',','.').'');
	}
	// for($i=1; $i<30; $i++){
	// 	$data2[]=array('1','EKA','1231');
	// }
	
?>
<div class="pages" >
	<table >
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<tr >
						<td>
							<div style="clear:both;"></div>
							<div class="nota line">NOTA RETUR</div>
							
								<div style="clear:both;"></div>
								<div class="line">
									<div class="headtable">
										<table class="tablecontent" border="0" style="width:100%;">
											<tr>
												<td width="100px">Faktur Pajak No</td>
												<td width="5px">:</td>
												<td><?php echo $model->faktur_pajak_no; ?></td>
												<td width="50px">Nomor</td>
												<td width="5px">:</td>						
												<td></td>
											</tr>
											<tr>
												<td width="100px">Invoice No.</td>
												<td width="5px">:</td>
												<td><?php echo $model->kwitansi; ?></td>
												<td width="50px">Tanggal</td>
												<td width="5px">:</td>						
												<td><?php echo Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-M-Y")?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="line">
									<div class="headtable">
										<table class="tablecontent" border="0" style="width:100%;">
											<tr>
												<td colspan="3">
													<span style="font-size:12px;"> PEMBELI</span>
												</td>
											</tr>
											<tr>
												<td width="100px">Nama </td>
												<td width="5px">:</td>
												<td><?php echo $model->partner->name; ?></td>
											</tr>
											<tr style="height:40px;">
												<td width="100px" valign="top">Alamat</td>
												<td width="5px" valign="top">:</td>
												<td>
													<?php echo $model->partner->street; ?><br/>
													<?php echo $model->partner->street2; ?><br/>
													<?php echo $model->partner->city; ?> <?php echo $model->partner->zip; ?> <br/>
												</td>
											</tr>
											<tr>
												<td width="100px">N.P.W.P</td>
												<td width="5px">:</td>
												<td><?php echo $model->partner->npwp ?></td>
											</tr>
											<tr>
												<td width="100px">N.P.P.K.P</td>
												<td width="5px">:</td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="line">
									<div class="headtable">
										<table class="tablecontent" border="0" style="width:100%;">
											<tr>
												<td colspan="3">
													<span style="font-size:12px;"> PENJUAL</span>
												</td>
											</tr>
											<tr>
												<td width="100px">Nama </td>
												<td width="5px">:</td>
												<td>PT. SUPRABAKTI MANDIRI</td>
											</tr>
											<tr>
												<td width="100px" valign="top">Alamat</td>
												<td width="5px" valign="top">:</td>
												<td>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</td>
											</tr>
											<tr>
												<td width="100px">N.P.W.P</td>
												<td width="5px">:</td>
												<td>01.327.742.1-038.000</td>
											</tr>
											<tr>
												<td width="100px">N.P.P.K.P</td>
												<td width="5px">:</td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
						</td>
					</tr>
					<tr style="margin-top:-3px;">
						<td>
							<table class="headtablepages" style="width:186mm; border:1px solid black; border-collapse: collapse; margin-top:-9px;">
									<tr>
										<th width="30px">No.</th>
										<th width="300px">Nama Barang Kena Pajak/ <br/> Jasa Kena pajak</th>
										<th width="74px">Quantity</th>
										<th width="121px">Harga Satuan <br/><?php echo $model->currency->name ?></th>
										<th width="162px">Harga BKP yang <br/>Dikembalikan (Rp)</th>
									</tr>
							</table>
							</td>
					</tr>
						<tr>
							<?php $maxHeight = '85mm'; ?>
							<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
								<div class="contentArea">
									<table class="contentLines">

									</table>
								</div>
							</td>
						</tr>
					<tr style="margin-top:-3px;">
						<td>
							<table class="foodtablepages" style="width:186mm; border:1px solid black; border-collapse: collapse; margin-top:-11px;">
									<tr>
										<th width="505px" >Jumlah Harga BKP yang dikembalikan</th>
										<th style="text-align:right;"><?php echo app\components\NumericLib::indoStyle($model->amount_untaxed,2,',','.') ?></th>
									</tr>
									<tr>
										<th>Pajak Pertambahan Nilai yang dikembalikan</th>
										<th style="text-align:right;"><?php echo app\components\NumericLib::indoStyle($model->amount_tax,2,',','.') ?></th>
									</tr>
									<tr>
										<th></th>
										<th style="text-align:right;">-</th>
									</tr>
							</table>
							</td>
					</tr>
				</table>
				<div style="float:right; display:block; width:200px;">
										Jakarta,<br/>
					PT.XXXXXXX
					<br/>
					<br/>
					<br/>
					Cap dan tanda tangan
					<br/>
					<br/>
					<br/>
					<br/>
					(Nama ...................)
					Jabatan
				</div>
			</td>
		</tr>
	</table>
</div>
</div>
<?php
$this->registerJs('
	var currPage = 1;

	// save page template to var
	var tmpl = \'<div class="break">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($data2).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		console.log(data[0]);
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:30px; text-align:center;\">"+data[0]+"</td><td style=\"width:300px; text-align:left;\">"+data[1]+"</td><td style=\"width:74px; text-align:center;\">"+data[2]+"</td><td style=\"width:121px; text-align:right;\">"+data[3]+"</td><td style=\"width:162px; text-align:right;\">"+data[4]+"</td></tr>";
	}

	var rowPage = 0;
	jQuery.each(lines,function(key,line){
		var getRow = prepareRow(currRow,line);
		if(key==0)
		{
			jQuery(\'table#lines\'+currPage).html(getRow);
		}
		else
		{
			jQuery(\'table#lines\'+currPage+\' tr:last\').after(getRow);
		}
		rowPage = rowPage+1;

		var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		console.log(\'Key \'+key+\' \'+currLineHeight);
		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
			
			var pageHeight=jQuery(\'#lines\'+currPage).height();
			// alert(pageHeight);
			var setLineHeight=439-pageHeight;
			
			var resLine = "<tr><td style=\"width:30px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:300px; text-align:center;\"></td><td style=\"width:74px; text-align:center;\"></td><td style=\"width:121px; text-align:center;\"></td><td style=\"width:162px; text-align:center;\"></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(resLine);

			// add new page container
			jQuery(\'div#page\'+currPage).after(tmpl);
			currPage = currPage+1;
			console.log(currPage);
			// add id to new div
			jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
			jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
			jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

			jQuery(\'table#lines\'+currPage).html(getRow);
			currLineHeight = jQuery(\'#tdLine\'+currPage).height();
			// console.log(tmpl);
		}

		
		console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
		currRow=currRow+1;
	});
		var HeightTable=jQuery(\'#tdLine\'+currPage).height();
		var cektable=jQuery(\'#lines\'+currPage).height();
		var SetHeight=HeightTable-cektable+35;

		if (cektable < HeightTable){
			var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:300px; text-align:center;\"></td><td style=\"width:74px; text-align:center;\"></td><td style=\"width:121px; text-align:center;\"></td><td style=\"width:162px; text-align:center;\"></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
		}
	// end loop
');
?>
