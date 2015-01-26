<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

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
		padding-top:17mm;
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
	.contentLines{
		font-size: 11pt;
	}
	.cRows{
		vertical-align: top;
	}

    .xxx{
        position: absolute;
        margin-left: -143mm;
        margin-top: -1mm;
        font-weight: bold;
    }
	.choosePrinter{
		position: absolute;
		z-index: 9999;
		right: 0;
	}
	.amVal{
		text-align: right;
		padding-right: 	20px;
	}
	.pbkp{
		margin-top: 41px;
		margin-left: 36mm;
		height: 88px;
	}

	.lineVal{
		text-align: right;
		padding-right: 20px;
	}

	<?php
    if($printer=='sri'):
        echo '.pages{padding-top: 11mm;}';
    endif;

    ?>
    .xxx{
    	margin-left: -147mm !important;
    }
    .spacerTd{
    	height: 8mm;
    }
    @media print{
        .xxx table, .xxx table tr, .xxx table tr td{
            border: 0px;

        }



		.choosePrinter{
			display: none;
		}
    }
</style>

<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
			<input type="hidden" value="<?=Url::to('account-invoice/print')?>" name="r" />
			<input type="hidden" value="<?=$model->id?>" name="id" />
			<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : <select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
		</select>
	</form>
</div>
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
							<div class="pkp" style="margin-top:8mm;margin-left:36mm;">
								<div style="margin-bottom:1mm;">PT. SUPRABAKTI MANDIRI</div>
								<div style="height:10mm;"><span>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</span></div>
								<div>01.327.742.1-038.000</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="pbkp">
								<div style="margin-bottom:2mm;" contenteditable="true">
									
									<?php
										$expPartnerName = explode(',',$model->partner->name );
										if(is_array($expPartnerName) && isset($expPartnerName[1])){
											$partnerName = $expPartnerName[1].'.'.$expPartnerName[0];
										}else{
											$partnerName = $model->partner->name;
										}
										echo $partnerName;

									?>
								</div>
								<div style="height:10mm;" contenteditable="true">
									<span>
										<?= $model->partner->street; ?><?= '<br/>'.$model->partner->street2 ?> <?= $model->partner->city ?>, <?= (isset($model->partner->state->name) ? $model->partner->state->name:'').($model->partner->zip ? ' - '.$model->partner->zip:"") ?>
									</span>
								</div>
								<div><span><?= ($model->partner->npwp ? $model->partner->npwp:'-'); ?></span></div>
							</div>
						</td>
					</tr>
					<tr>
						<?php $maxHeight = '103mm'; ?>
						<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
							<div class="contentArea">
								<table class="contentLines" style="width:100%;margin-top:16mm;">
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
							<div class="amount">
								<div class="xxx">
                                    <table border="1px solid black" cellpadding="0">
                                        <tr>
                                            <td style="width:18mm;" contenteditable="true">XXXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="amVal">
										<?= Yii::$app->numericLib->indoStyle($model->amount_untaxed); ?>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="spacerTd">
							<div class="amount">&nbsp;</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="amount"><div class="amVal"><?= (isset($model->amount_untaxed) ? Yii::$app->numericLib->indoStyle($model->amount_untaxed):''); ?></div></div>
						</td>
					</tr>
					<tr>
						<td><div class="amount"><div class="amVal"><?= (isset($model->amount_tax) ? Yii::$app->numericLib->indoStyle($model->amount_tax):''); ?></div></div></td>
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
	var poNo = "'.$model->name.'";
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($lines).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:38px;\">"+eval(rowNo+1)+"</td><td contenteditable=\"true\" style=\"width:440px;\">"+data.name+"</td><td class=\"lineVal\">"+data.price_subtotal+"</td></tr>";
	}

	function prepareNoteRow(rowNo,data)
    {
        return "<tr class=\'cRows rows"+rowNo+"\'><td>&nbsp;</td><td colspan=\"2\" contenteditable=\"true\">"+data.name+"</td></tr>";
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

	var noteRow = prepareNoteRow(currRow,{name:\'PO No : \'+poNo});
    jQuery(\'table#lines\'+currPage+\' tr:last\').after(noteRow);
	// end loop
');
?>