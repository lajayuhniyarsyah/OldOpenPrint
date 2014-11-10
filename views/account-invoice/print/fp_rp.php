<style type="text/css">
	table{
		/* border-top: 1px solid black;
		border-bottom: 1px solid black; */
	}
	.header{
		height: 10%;
	}
	.content{
		height: 80%;
	}
	.pages{
		height: 245mm;
		padding-top:16mm;
		padding-left:4mm;
		page-break-after: always;
	}
	.amount{
		margin-left:76%;
	}
	.lineFoot{
		padding-left: 74%;
	}
	.mrgBtm1{
		margin-bottom: 1%;
	}
	.sign{
		margin-top: 15mm;
		padding-left: 58%;
	}
	.sign .signName{
		margin-top: 29%;
		margin-left: 9%;
	}
</style>
<div id="pageContainer">
<div class="pages">
	<table style="width:190mm;height:100%;border-right:0px solid black;">
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<tr>
						<td>
							<div>Inv. <?=$model->kwitansi?></div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="margin-left:50mm;margin-top:2mm;"><?=$model->faktur_pajak_no?></div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="pkp" style="margin-top:7mm;margin-left:36mm;">
								<div style="margin-bottom:1mm;">PT. SUPRABAKTI MANDIRI</div>
								<div style="height:10mm;"><span>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</span></div>
								<div>01.327.742.1-038.000</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="pbkp" style="margin-top:12mm;margin-left:36mm;">
								<div style="margin-bottom:2mm;"><?= $model->partner->name; ?></div>
								<div style="height:10mm;">
									<span>
										<?= $model->partner->street; ?><?= '<br/>'.$model->partner->street2 ?> <?= $model->partner->city ?> <?= $model->partner->zip ?>
									</span>
								</div>
								<div><span><?= ($model->partner->npwp ? $model->partner->npwp:'-'); ?></span></div>
							</div>
						</td>
					</tr>
					<tr>
						<?php $maxHeight = '105mm'; ?>
						<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
							<div class="contentArea">
								<table class="contentLines" style="width:100%;margin-top:18mm;">
									<!-- <?php foreach($model->accountInvoiceLines as $cSeq=>$invoiceLine): ?>
									<tr class="cRows rows<?=$cSeq?>" style="vertical-align:top;">
										<td style="width:6%;"><?=$invoiceLine->sequence?></td>
										<td style="width:70%"><?php if(isset($invoiceLine->product)) : ?>[<?= $invoiceLine->product->default_code ?>]<?php endif; ?> <?= $invoiceLine->name ?></td>
										<td><?= $invoiceLine->price_subtotal ?></td>
									</tr>
									<?php endforeach; ?> -->
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="amount"><?= $model->amount_untaxed; ?></div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="amount">&nbsp;</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="amount">&nbsp;</div>
						</td>
					</tr>
					<tr>
						<td><div class="amount"><?= (isset($model->amount_untaxed) ? $model->amount_untaxed:''); ?></div></td>
					</tr>
					<tr>
						<td><div class="amount"><?= (isset($model->amount_tax) ? $model->amount_tax:''); ?></div></td>
					</tr>
					<tr>
						<td>
							<div class="sign">
								<div class="tgl">Jakarta <span style="margin-left:30%;"><?= Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-m-Y"); ?></span></div>
								<div class="signName"><?= strtoupper($model->approver0->partner->name); ?></div>
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
	var tmpl = \'<div style="height:2mm;">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($model->accountInvoiceLines).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:6%;\">"+eval(rowNo+1)+"</td><td style=\"width:70%\">"+data.name+"</td><td>"+data.price_subtotal+"</td></tr>";
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
		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
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
	// end loop
');
?>