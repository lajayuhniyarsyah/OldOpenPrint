<?php
use yii\helpers\Url;


?>
<style type="text/css">
	#pageContainer{
		width: 198mm;
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
		padding-top:5mm;
		padding-left:4mm;
		page-break-after: always;
	}
	.logo{
		width: 140mm;
		margin-top: -85px;
		float: left;
	}
	.logo img{
		margin-top:10px;
		margin-left: 10px;
		display: block;
	}
	.judul{
		font-size: 22px;
		margin-top: -35px;
		margin-left: 15px;
		font-family: Geneva, Arial, Helvetica, sans-serif;
		
		float: center;
		letter-spacing: 1px;
	}
	.iso{
		margin-top:10px;
		float: right;
		width: 50mm;
	}
	.do{
		font-size: 16px;
		font-weight: bold;
		margin-left: 16px;
		margin-top: 10px;
		/*position: absolute;*/
		/*font-family: Times New Roman;*/
		float: left;
	}
	.yth{
		display: block;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 12px;
		margin-left: 16px;
		width: 98%;
		line-height: 17px;
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
		border: 1px black solid;
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
		font-size: 12px;
		line-height: 15px;
		text-align: center;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:100%; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
	}
	.tablefooter td{
		border: medium none !important;
		/*font-family: Times New Roman;*/
		font-size: 12px;
		padding-left: 10px;
		line-height: 17px;
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
		/*line-height: 30px;*/
		font-size: 11px;
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
		margin-left: 15px;
		width: 186mm;
		margin-top: -9px;
		border-bottom:  1px solid black;
	}
	.contentLines tbody tr td {
		border-left:  1px solid black;
		border-right:  1px solid black;
		border-collapse: collapse;
		line-height: 17px;
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
		width:98%; float:left;  margin-left: 15px;margin-top: -9px;
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
	.rigthheadtable{
		float: right;
		width: 50%;
	}
	.leftheadtable{
		float: left;
		width: 50%;
		border-right: 1px solid black;
	}
	.cus{
		font-size: 16px;
		font-weight: bold;
	}
	.almt{
		font-size: 10px;
	}
	.dtlcus{
		font-size: 13px;
		margin-left: 5px;
	}
	.total{
		 width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;margin-top:-9px;
	}
	.total td{
		border:1px solid black;
		font-size: 13px;
	}
</style>
	<?php 

		$test="EKA CHANDRA";
		echo ucwords("EKA CHANDRA");
		$no=1;
		foreach ($model->purchaseOrderLines as $value){
				$data2[]=array(
								$no,
								$value->name,
								$value->product->default_code,
								$value->product_qty,
								$value->productUom->name,
								app\components\NumericLib::indoStyle($value->price_unit,2,',','.'),
								app\components\NumericLib::indoStyle($value->price_unit*$value->product_qty,2,',','.'));
						$no++;
				}
		$data2[]=array('','<br/><br/>'.$model->notes,'','','','','');
	?>
<div id="pageContainer">
<div class="pages">
	<table>
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<tr>
						<td>
							<div class="judul"><strong><h3><center>PURCHASE ORDER</center></h3></strong></div>
							<div class="logo">
								<img style="width:85px; float:left" src="<?= Url::base() ?>/img/logo.png">
								<div style="clear:both;"></div>
								<div class="dataiso">SBM-F-PCH-02/01<br/>
									12/01/30</div>
							</div>
							<div style="clear:both;"></div>
							<div class="do">PT.SUPRABAKTI MANDIRI</div>
							<div style="clear:both;"></div>
								<div class="yth">
								Workshop : JL.Raya Pasar Kemis Km 3,5 Desa Kutajaya Tangerang 15560 Banten,Telp (021) 5903436-38, Fax.(021) 5903747<br/>
								Head Office : GRAHA SUPRA JL.Danau Sunter Utara Blok A No.9 Jakarta Utara 14350 Indonesia<br/>
								Telp : (021) 658 33666 Hunting, Fax (021) 658 31666, Website : www.beltcare.com
								</div>
								<div style="clear:both;"></div>
								<div class="headtable">
									<table class="tablecontent leftheadtable">
										<tr>
											<td>
												<div style="margin-top:10px;">Kepada Yth</div>
												<div class="cus">
													<?php  echo $model->partner->name; ?>
												</div>
												<div class="almt">
													<?php echo $model->partner->street; ?>
												</div>
												<br/>
												<table class="dtlcus">
													<tr>
														<td width="30px">Telp</td>
														<td><?php echo $model->partner->phone; ?></td>
													</tr>
													<tr>
														<td>Fax</td>
														<td><?php echo $model->partner->fax; ?></td>
													</tr>
													<tr>
														<td>Attn</td>
														<td><?php 
															if($model->attention0==""){
																$att='-';
															}else{
																$att=$model->attention0->name;
															}
															echo $att;
															?></td>
													</tr>
												</table>
											</td>												
										</tr>
									</table>
									<table class="tablecontent rigthheadtable">
										<tr>
											<td>
												<br/>
												<table class="dtlcus">
													<tr>
														<td width="100px">Nomor PO</td>
														<td><?php echo $model->name; ?></td>
													</tr>
													<tr>
														<td>Tanggal</td>
														<td><?php echo Yii::$app->formatter->asDatetime($model->date_order, "php:d-M-Y")?></td>
													</tr>
													<tr>
														<td>Pembayaran</td>
														<td><?php echo $model->term_of_payment; ?></td>
													</tr>
													<tr>
														<td>Nomor F-PB</td>
														<td><?php echo $model->origin; ?></td>
													</tr>
													<tr>
														<td>Due Date</td>
														<td><?php echo Yii::$app->formatter->asDatetime($model->duedate, "php:d-M-Y") ?></td>
													</tr>
												</table>
											</td>						
										</tr>
									</table>
								<div style="clear:both;"></div>
								</div>
						</td>
					</tr>
					<tr>
						<td>
							<table class="headtablepages" style="width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;">
									<tr>
										<th width="30px">No.</th>
										<th width="265px">DESCRIPTION</th>
										<th width="89px">PART NO</th>
										<th width="60px">QTY</th>
										<th width="50px">UNIT</th>
										<th width="93px">HARGA<br/>IDR</th>
										<th width="94px">TOTAL<br/>IDR</th>
									</tr>
							</table>
										</td>
									</tr>
									<tr>
										<?php $maxHeight = '100mm'; ?>
										<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
											<div class="contentArea">
												<table class="contentLines">
														
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<table class="total">
													<tr>
														<td colspan="3" width="199px"></td>
														<td colspan="3" width="106px">TOTAL AMOUNT</td>
														<td width="94px" align="right"><?php echo app\components\NumericLib::indoStyle($model->amount_untaxed,2,',','.') ?></td>
													</tr>
													<tr>
														<td colspan="3"></td>
														<td colspan="3">Discount</td>
														<td align="right"></td>
													</tr>
													<tr>
														<td colspan="3"></td>
														<td colspan="3">PPN 10%</td>
														<td align="right"><?php echo app\components\NumericLib::indoStyle($model->amount_tax,2,',','.') ?></td>
													</tr>
													<tr>
														<td colspan="3"></td>
														<td colspan="3">GRAND TOTAL</td>
														<td align="right"><?php echo app\components\NumericLib::indoStyle($model->amount_total,2,',','.') ?></td>
													</tr>
											</table>
										</td>
									</tr>
									<tr>
									<td>
									<div class="tablettd">

										<table class="tablefooter">
										<tr>
											<td>
												<div style="margin-top:-15px; margin-bottom:15px; font-size:15px;">
													PENAGIHAN HARUS MELAMPIRKAN
												</div>
												<div class="ket">
												1). Copy PO dan Faktur Pajak ASLI Rangkap 2 <br/>
													2). Kwitansi ASLI dan Surat Jalan (DO) ASLI<br/>
													3). NPWP/NPPKP Suprabakti Mandiri : 01.327.742.1-038.000<br/>
													4). Alamat NPWP : JL.Danau Sunter Utara Blok A No.9 Tanjung Priuk<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta Utara 14350<br/>
													5). Pengiriman Barang harus melampirkan Surat Jalan Rangkap
												</div>
											</td>
											<td>
											Disetujui Oleh<br/><br/><br/><br/><br/>
											(.......................)<br/>Date:
											</td>
										</tr>
									</table>
									</div>
						</td>
					</tr>
					
				</table>
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
		return "<tr class=\'cRows rows"+rowNo+"\'><td width=\'30px\' style=\"text-align:center;\">"+data[0]+"</td><td style=\"text-align:left;\" width=\'265px\'>"+data[1]+"</td><td width=\'89px\'><div class=\"leftdata\">"+data[2]+"</div></td><td width=\'60px\' style=\"text-align:center;\"><div class=\"center\">"+data[3]+"</div></td><td style=\"text-align:center;\" width=\'50px\'>"+data[4]+"</td><td style=\"text-align:right;\" width=\'93px\'>"+data[5]+"</td><td width=\'94px\' style=\"text-align:right;\">"+data[6]+"</td></tr>";
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
			
			var resLine = "<tr class=\'cRows rows"+rowNo+"\'><td width=\'30px\' style=\"text-align:center;\"></td><td style=\"text-align:left;\" width=\'265px\'></td><td width=\'89px\'><div class=\"leftdata\"></div></td><td width=\'60px\' style=\"text-align:center;\"><div class=\"center\"></div></td><td style=\"text-align:center;\" width=\'50px\'></td><td style=\"text-align:right;\" width=\'93px\'></td><td width=\'94px\' style=\"text-align:right;\"></td></tr>";";
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
			var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:130px; text-align:center;\"></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
		}
	// end loop
');
?>
