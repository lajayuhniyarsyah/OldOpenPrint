<?php
use yii\helpers\Url;


?>
<style type="text/css">
	#pageContainer{
		width: 200mm; height: 297mm;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
	}
	table{
		/* border-top: 1px solid black;
		border-bottom: 1px solid black; */
	}
	.contener{
		border: 1px solid black;
		width: 200mm; height: 297mm;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
	}
	.header{
		height: 10%;
	}
	.content{
		height: 80%;
	}

	.pages{
		height: 245mm;
		padding-top:5mm;
		padding-left:4mm;
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
		margin-top: -5px;
		/*position: absolute;*/
		float: left;
		text-decoration: underline;
	}
	.yth{
	 	display: block;
	    float: left;
	    font-size: 17px;
	    margin-left: 16px;
	    margin-top: 12px;
	    width: 50%;
	}
	.customer{
		float: right;
		width: 40%;
		display: block;
		margin-right: 10px;
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
		margin-top: 15px; margin-left: 10px;
		font-size: 16px;
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
		text-align: center;
		border: 1px solid black;
		line-height: 30px;
		font-size: 18px;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:430px; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
	}
	.tablefooter td{
		text-align: center;
		border: none !important;
		font-size: 13px;
	}
	.isigudang{
		margin-top:10px;
		margin-left: 40px;
		text-align: left;
		font-weight: bold;
	}
	.gudang{
		margin-left: 40px;
		border: none;
	}
	.gudang td{
		line-height: 30px;
		border: none !important;

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
		line-height: 30px;
		font-size: 13px;
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
		line-height: 25px;
		font-size: 13px;
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
		float: left;margin-left: 0px;margin-top: -1px; margin-left:15px; border-collapse: collapse;  line-height: 30px;
	}
	.dataiso{
		text-align: center;
		width: 100px;
		float: left;
		font-size: 9px;
		margin-left: 2px;
	}
</style>
	<?php 

		foreach ($model->orderPreparationLines as $value) {
				$databatch=[];
				foreach ($value->orderPreparationBatches as $batch) {
					if ($batch->exp_date==""){
						$databatch[]='Batch No : '.$batch->name0->name.' '.$batch->name0->desc.' Qty :'.$batch->qty.' '.$no=$value->productUom->name.'<br/>';
					}else{
						$databatch[]='Batch No : '.$batch->name0->name.' '.$batch->name0->desc.' Exp Date : '.$batch->name0->exp_date.' Qty :'.$batch->qty.' '.$no=$value->productUom->name.'<br/>';	
					}
					
				}
				$desc=$value->name.'<br/>'.implode($databatch);
				if ($value->no==""){
					$no='';
				}else{
					$no=$value->no;					
				}

				$data2[]=array($no,$value->product_qty.' '.$no=$value->productUom->name,$desc,$value->product->default_code);

		}
		$data2[]=array('','','<br/><br/>'.$model->terms,'');
	?>
<div id="pageContainer">
<div class="pages">
	<table>
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<tr>
						<td>
							<div class="logo">
								<img style="width:85px; float:left" src="<?= Url::base() ?>/img/logo.png">
								<div style="clear:both;"></div>
								<div class="dataiso">SMB-F-SA-04b/01<br/>
									12/09/10</div>
								<div class="judul"><strong><h3>PT.SUPRABAKTI MANDIRI</h3></strong></div>
							</div>
							<div class="iso">
								<img style="width:100%; float: right;" src="<?= Url::base() ?>/img/iso.jpg">
							</div>
							<div style="clear:both;"></div>
							<div class="do">DELIVERY ORDER</div>
							<div style="clear:both;"></div>
								<div class="yth">
									Kepada Yth.<br/>
									Sdr. Kepala Gudang<br/>
									Di tempat<br/><br/>
									Harap disiapkan sejumlah barang dibawah ini :
								</div>
								<div class="customer">
									<fieldset>
										<div class="isicus">
										<?php echo $model->partner->name; ?><br/>
										<?php echo $model->partner->street; ?><br/>
											021-2591818<br/>
										</div>
									</fieldset>
								</div>

								<div style="clear:both;"></div>
								<div class="headtable">
									<table class="tablecontent">
										<tr>
											<td width="70px">No.DO</td>
											<td>:</td>
											<td width="220px"><?php echo $model->name; ?></td>

											<td width="50px">No.SC</td>
											<td>:</td>
											<td width="150px"></td>

											<td width="50px">No.WC</td>
											<td>:</td>
											<td></td>							
										</tr>
									</table>
								</div>
								<div class="headtable" style="margin-top:-1px;">
									<table class="tablecontent">
										<tr>
											<td width="70px">Tanggal.DO</td>
											<td>:</td>
											<td width="220px"><?php echo $model->duedate; ?></td>

											<td width="50px">No.PO</td>
											<td>:</td>
											<td width="150px"><?php echo $model->poc; ?></td>

											<td width="50px">No.SPK</td>
											<td>:</td>
											<td></td>							
										</tr>
									</table>
								</div>
						</td>
					</tr>
					<tr>
						<td>
							<table class="headtablepages" style="width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;">
									<tr>
										<th width="50px">No.</th>
										<th width="130px">Jumlah</th>
										<th>Nama Barang</th>
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
									<div class="tablettd">
										<table class="tablefooter">
										<tr>
											<td>
												Dibuat Oleh :<br/><br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
											<td>
												Dicek Oleh ,<br/><br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
											<td>
												Disetujui Oleh,<br/> General Manager,<br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
										</tr>
									</table>
									</div>
									<div style="float:right; width:285px; margin-left:15px; margin-top:-15px;">
										<div class="isigudang">DIISI OLEH GUDANG </div>
										<br/>
										<table class="gudang">
											<tr>
												<td width="110px">No.PBB</td>
												<td>:</td>
												<td>...............................</td>
											</tr>
											<tr>
												<td width="110px">Tgl. Pengambilan</td>
												<td>:</td>
												<td>...............................</td>
											</tr>
											<tr>
												<td width="110px">Diambil Oleh</td>
												<td>:</td>
												<td>...............................</td>
											</tr>
										</table>
									</div>
								<div style="clear:both;"></div>
								<table class="tblkirim">
									<tr>
										<td width="220px" style="border:1px solid black; ">
											No SJ :
										</td>
										<td class="tglkirim" style="border:1px solid black; ">
										Tgl Kirim :
										</td>
										<td>

											<div style="margin-left:50px;">
												(.........................................)
											</div>
										</td>
									</tr>
								</table>
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
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:50px; text-align:center;\">"+data[0]+"</td><td style=\"width:130px; text-align:center;\">"+data[1]+"</td><td><div class=\"leftdata\">"+data[2]+"</div><div class=\"rightdata\">"+data[3]+"</div></td></tr>";
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
			var setLineHeight=403-pageHeight;
			
			var resLine = "<tr><td style=\"width:50px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:130px; text-align:center;\"></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
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
		var SetHeight=HeightTable-cektable+25;

		if (cektable < HeightTable){
			var res = "<tr><td style=\"width:50px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:130px; text-align:center;\"></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
		}
	// end loop
');
?>
