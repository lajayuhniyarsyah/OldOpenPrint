<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style type="text/css">
	body{
		font-family: Tahoma, Geneva, sans-serif;
		padding-top: 0px;
	}
	.signName{
		padding-left:127mm;
		margin-top: 3mm;
	}
	
	#container
	{
		width: 190mm;
		/*border: 1px solid black;*/
		padding-left: 8mm;
		vertical-align: top;
	}
	.clear
	{
		clear: both;
	}
	.headers
	{
		padding-top:58mm;
		height: 33mm;
	}
	.leftInfo
	{
		background: red;
		float: left;
		margin-top: -5mm;
		width: 130mm;
		max-height: 36mm;
	}
	.rightInfo
	{
		float: right;
	}
	.kwNo{
		height: 10mm;
		padding-right: 10mm;
		line-height: 4mm;
	}
	.dateInv{
		height: 10mm;
		line-height: 4mm;
	}
	.pages
	{
		/*border-top: 1px solid lime;
		border-bottom: 1px solid red;*/
		page-break-after: always;
		height: 330mm;
		background: grey;
	}
	#container .pages:not(:first-child){
		padding-top: 4mm;
	}


	.containerLines{
		min-height: 117mm;
		overflow: hidden;
		/*max-height: 117mm;*/
		/*height: 117mm;*/
		background: lime;
		font-size: 11pt;
		/*border-bottom: 1px solid black;*/
		/*color: white;*/

	}

	
	.containerLines table tr td{
		vertical-align: top;
	}
	.amounts{
		float: right;
		font-size: 11pt;
		
	}
	.amounts div.am{
		text-align: right;
		height: 24px;
		width: 130px;
		padding-right: 5mm;
		/*background: lime;*/
	}
	.amounts .currSymbol{
		width: 30px;
		float: left;
		
	}
	.amounts .amountNumber{
		float: left;
		text-align: right;
		width: 86px;
	}
	.amLine2{
		/*border: 1px solid black;*/
	}
	.am2Words{
		border: 1px solid black;
		float: left;
		width: 150px;
		height: 100%;
		margin-left: -171px;

	}
	.kursAm2{
		border: 1px solid black;
		float: left;
		width: 35px;
		height: 100%;
		margin-left: -6px;

	}
	.valAm2{
		border: 1px solid black;
		height: 100%;
		padding-right: 10px;
		width: 80px;
		float: right;
	}
	.amLine3{
		margin-top: 6mm;
	}
	.notes{
		clear: both;
	}
	.terb{
		padding-top:13mm;
		padding-left:5mm;
		font-size: 11pt;
		font-weight: bold;
		background: yellow;
		height: 20mm;
		width: 433px;
		vertical-align: top;
		line-height: 18px;
	}
	.dueDate{
		margin-left: 50mm;
		/*padding-top:0mm;*/
		font-size: 11pt;
	}


	.td1{
		width: 6mm;
	}
	.td2{
		width: 24mm;
	}
	.td3{
		width: 82mm;
	}
	.td4{
		/*width:36mm;*/
		width: 120px;
	}
	.td5{
		width: 120px;
		padding-left: 11px;
	}

	.invFootNotes{
		margin-left: -2mm;
		padding-top: 16mm;
		font-size:10pt;
		font-weight: bold;
		letter-spacing: -1px;
	}
	.choosePrinter{
		position: absolute;
		z-index: 9999;
		right: 0;
	}
	@media print
	{
		#container{
			border: none;
		}
		.containerLines{
			/*border-bottom: 1px solid black;*/

		}
		.choosePrinter{
			display: none;
		}

		.amLine2{
			border: none;
		}

		.am2Words{
			border: none;

		}
		.kursAm2{
			border: none;
		}
		.valAm2{
			border: none;
		}
	}

	<?php

	
	if($printer=='sri'){
		echo '.headers{padding-top:56mm;height: 32mm;}.kwNo{line-height: 2mm;}.terb{padding-top: 11mm;line-height: 35px;}';
	}elseif($printer=='refa'){
		?>
		.td1{
			width: 6mm;
		}
		.td2{
			width: 24mm;
		}
		.td3{
			width: 315px;
		}
		.td4{
			/*width:36mm;*/
			width: 120px;
		}
		.td5{
			width: 120px;
			padding-left: 11px;
		}
		.dateInv{
			height: 10mm;
			line-height: 32px;
		}
		.footers{
			padding-top: 9px;
		}
		.terb {
		    padding-top: 11mm;
		    line-height: 35px;
		}
		<?php
	}
	?>
</style>
<?php

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
			<input type="hidden" value="<?=Url::to('account-invoice/print-invoice')?>" name="r" />
			<input type="hidden" value="<?=$model->id?>" name="id" />
			<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : <select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
		</select>
	</form>
</div>
<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="leftInfo">
				<div class="partnerName" contenteditable="true">
					<?php
						$prtName = (isset($model->partner->parent) ? $model->partner->parent->name:$model->partner->name);
						$expPartnerName = explode(',',$prtName );
						if(is_array($expPartnerName) && isset($expPartnerName[1])){
							$partnerName = $expPartnerName[1].'.'.$expPartnerName[0];
						}else{
							$partnerName = $model->partner->name;
						}
						echo $partnerName;

					?>
				</div>
				<div class="partnerAddr" contenteditable="true"><?=$model->partner->street?></div>
				<div class="partnerAddr2" contenteditable="true"><?=$model->partner->street2?></div>
				<div class="partnerAddr2" contenteditable="true"><?=$model->partner->city.' '.(isset($model->partner->state->name) ? $model->partner->state->name.' - ':'').$model->partner->zip?></div>
				
			</div>
			<div class="rightInfo">
				<div class="kwNo"><?=$model->kwitansi?></div>
				<div class="dateInv" contenteditable="true"><?=Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-m-Y")?></div>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		<div class="superContain" style="max-height:117mm;">
			<div class="containerLines">
				<table class="contentLines">
					<!-- <tr></tr> -->
				</table>
			</div>
		</div>
		<div class="footers">
			<div class="amounts">
				<div class="amLine1 am"><?='<div class="currSymbol">'.$model->currency->name.'</div><div class="amountNumber">'.$formated($total).'</div><div class="clear"></div>'?></div>
				<div class="amLine2 am">
					<div class="am2Words" contenteditable="true"><?=$discountLine['desc']?></div>
					<div class="kursAm2" contenteditable="true"><?=$discountLine['currCode']?></div>
					<div class="valAm2" contenteditable="true"><?=($discountLine['amount'] !='' ? $formated(-$discountLine['amount']):null)?></div>
				</div>
				<div class="amLine3 am"><?='<div class="currSymbol">'.$model->currency->name.'</div><div class="amountNumber">'.$formated($model->amount_untaxed).'</div><div class="clear"></div>'?></div>
				<div class="amLine4 am"><?='<div class="currSymbol">'.$model->currency->name.'</div><div class="amountNumber">'.$formated($model->amount_tax).'</div><div class="clear"></div>'?></div>
				<div class="amLine5 am"><?='<div class="currSymbol">'.$model->currency->name.'</div><div class="amountNumber">'.$formated($model->amount_total).'</div><div class="clear"></div>'?></div>
			</div>
			<div class="notes">
				<div class="terb" contenteditable="true">
					<?php
					
					switch (trim($model->currency->name)) {
						case 'USD':
							# code...
							$preCur = '# United State Dollar ';
							$subCur = "#";
							break;
						case 'SGD':
							$preCur = '# Singapore Dollar ';
							$subCur = "#";
							break;
						case 'EUR':
							$preCur = '# EURO';
							$subCur = "#";
							break;
						case 'IDR':
							$preCur = '#';
							$subCur = " Rupiah#";
							break;
						default:
							# code...
							$preCur='#';
							$subCur = "#";
							break;
					}
					echo $preCur;
					?>
					<?=ucwords(Yii::$app->numericLib->convertToWords($model->amount_total,$model->currency->name))?>
					<?=$subCur?>

				</div>
				<div class="dueDate"><?=(isset($model->paymentTerm->name) ? $model->paymentTerm->name:"")?></div>
				<div class="invFootNotes" contenteditable="true">
					Bank Mandiri Cab. Ketapang Indah, Jakarta -> A/C : 115-000-122-6655 (IDR)
					<br>
					Bank Mandiri Cab. Sunter Mall, Jakarta -> A/C : 120-000-669-0205 (USD)
					<br/>
					Bank Mandiri Cab. Sunter Mall, Jakarta -> A/C : 120-000-991-1988 (EUR)
					<br/>
					Bank CIMB Niaga Cab. Wahid Hasyim, Jakarta -> A/C : 4230-3000-02-008 (AUD)
				</div>
				<div class="signName" contenteditable="true"><?=strtoupper($model->approver0->partner->name)?></div>
			</div>
		</div>
	</div>
</div>

<?php
$jsonLines = \yii\helpers\Json::encode($lines);
$jsonModel = \yii\helpers\Json::encode($model);
// var_dump($jsonModel);
$scr = <<<EOD
var currPage = 1;

// save page template to var
var tmpl = jQuery('div#container').html();

// add id to container
jQuery('div.pages').attr('id','page'+currPage);
jQuery('table.contentLines:last').attr('id','lines'+currPage);
jQuery('.containerLines:last').attr('id','tdLine'+currPage);


// data to render
var lines = $jsonLines;
var model = $jsonModel;
var maxLinesHeight = jQuery('.containerLines:last').height();


var currRow = 0;

console.log(maxLinesHeight);

function prepareRow(rowNo,data)
{
	return "<tr class='cRows rows"+rowNo+"'><td class='td1'>"+data.no+"</td><td class='td2'>"+data.qty+"</td><td class='td3' contenteditable='true'>"+data.desc+"</td><td class='td4'>"+data.unit_price+"</td><td class='td5'>"+data.ext_price+"</td></tr>";
}

function getNotes(notes,rowNo=999999)
{
	return "<tr class='cRows rows"+rowNo+"'><td style='width:23%;'></td><td style='width:57%;padding-top:10mm;'>Notes : <br/>"+notes+"</td><td></td></tr>";
}
var rowPage = 0;



jQuery.each(lines,function(key,line){
	var getRow = prepareRow(currRow,line);
	if(key==0)
	{
		jQuery('#lines'+currPage).html(getRow);
	}
	else
	{
		jQuery('#lines'+currPage+' tr:last').after(getRow);
	}
	rowPage = rowPage+1;

	var currLineHeight = jQuery('#tdLine'+currPage).height();
	if(currLineHeight>maxLinesHeight){
		// remove last row
		jQuery('#lines'+currPage+' tr:last').remove();
		// add new page container
		jQuery('div#page'+currPage).after(tmpl);
		console.log('div#page'+currPage);
		currPage = currPage+1;
		console.log(currPage);
		// add id to new div
		jQuery('div.pages:last').attr('id','page'+currPage);
		jQuery('.contentLines:last').attr('id','lines'+currPage);
		jQuery('.containerLines:last').attr('id','tdLine'+currPage);

		jQuery('#lines'+currPage).html(getRow);
		currLineHeight = jQuery('#tdLine'+currPage).height();
		// jQuery('.pager:last').html(currPage);
		// console.log(tmpl);
		
	}
	
	console.log('Rendering Page '+currPage+' Row '+currRow+' Height => '+currLineHeight);
	currRow=currRow+1;
});
// end loop
var currIndex = 0;
function refreshActButton(currIndex){
	jQuery('.btnActLine').remove();
	jQuery('.td5').each(function(ro,v){
		jQuery(this).append('<div class="btnActLine hideOnPrint" style="margin-left: 150px;position: absolute;"><a href="#" class="btnCutRow" data="'+ro+'">Cut</a><a href="#" data="'+ro+'" class="btnPaste btnPasteBefore hidden"> | Paste Before</a><a href="#" class="btnPaste btnPasteAfter hidden" data="'+ro+'"> | Paste After</a></div>');
		currIndex = currIndex+1;
		return currIndex;
	});
}

currIndex = refreshActButton();

var trCopy = "";
var trCopyIdx;
/*jQuery('.btnCutRow').click(function(){
	trCopy = jQuery(this).parents("tr").html();
	trCopyIdx = jQuery(this).attr('data');
	console.log(trCopy);
	jQuery('.btnPaste').show();
	return false;
});

jQuery('.btnPasteAfter').click(function(){
	var roNo = jQuery(this).attr('data');
	jQuery("<tr>"+trCopy+"</tr>").insertAfter('tr:eq('+roNo+')');
	jQuery("tr:eq("+trCopyIdx+")").remove();
	trCopy = "";
	trCopyIdx = "";
	jQuery('.btnPaste').hide();
	return false;
});*/

jQuery('#container').on('click','.btnCutRow',function(e){
	e.preventDefault();
	var target = jQuery(this).parents("tr");
	jQuery(this).parent().remove();
	trCopy = target.html();
	trCopyIdx = jQuery(this).attr('data');
	console.log("THtml = "+trCopy+". Index = "+trCopyIdx);
	jQuery('.btnPaste').show();
	console.log("Removing TR "+trCopyIdx);
	jQuery("tr.rows"+trCopyIdx).remove();
	return false;
});

jQuery('#container').on('click','.btnPasteAfter',function(e){
	e.preventDefault();
	var roNo = jQuery(this).attr('data');
	
	
	console.log("inserting after "+roNo);
	currIndex = currIndex+1;
	jQuery('<tr class="cRows rows'+currIndex+'"></tr>'+trCopy+"</tr>").insertAfter('tr.rows'+roNo);
	console.log(jQuery('tr.rows'+currIndex+' .btnCutRow').attr('class'));
	trCopy = "";
	trCopyIdx = "";
	jQuery('.btnPaste').hide();
	return false;
});

jQuery('#container').on('click','.btnPasteBefore',function(e){
	e.preventDefault();
	var roNo = jQuery(this).attr('data');
	console.log("inserting before "+roNo);
	currIndex = currIndex+1;
	jQuery('<tr class="cRows rows'+currIndex+'"></tr>'+trCopy+"</tr>").insertBefore('tr.rows'+roNo);
	console.log(jQuery('tr.rows'+currIndex+' .btnCutRow').attr('class'));
	trCopy = "";
	trCopyIdx = "";
	jQuery('.btnPaste').hide();
	return false;
});
EOD;
unset($jsonLines);
$this->registerJs($scr);
?>
