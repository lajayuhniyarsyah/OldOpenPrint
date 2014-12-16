<style type="text/css">
	body{
		padding-top: 0px;
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
		padding-top:59mm;
		height: 33mm;
	}
	.leftInfo
	{
		background: red;
		float: left;
		margin-top: -5mm;
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
		height: 294mm;
		background: grey;
	}
	#container .pages:not(:first-child){
		padding-top: 4mm;
	}


	.containerLines{
		min-height: 116mm;
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
		font-size: 11pt
	}
	.amounts div{
		height: 25px;
		padding-right: 5mm;
	}
	.amLine3{
		margin-top: 6mm;
	}
	.notes{
		clear: both;
	}
	.terb{
		padding-top:12mm;
		font-size: 10pt;
		font-weight: bold;
		background: yellow;
		height: 20mm;
		width: 135mm;
		vertical-align: top;
	}
	.dueDate{
		margin-left: 40mm;
		font-size: 10pt;
	}


	.td1{
		width: 6mm;
	}
	.td2{
		width: 24mm;
	}
	.td3{
		width: 85mm;
	}
	.td4{
		width:36mm;
	}
	.td5{
		
	}

	@media print
	{
		#container{
			border: none;
		}
		.containerLines{
			/*border-bottom: 1px solid black;*/


		}
	}
</style>
<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="leftInfo">
				<div class="partnerName"><?=$model->partner->name?></div>
				<div class="partnerAddr"><?=$model->partner->street?></div>
				<div class="partnerAddr2"><?=$model->partner->street2?></div>
				<div class="partnerAddr2"><?=$model->partner->zip?></div>
				<div class="partnerPhone"><?=$model->partner->phone?></div>
			</div>
			<div class="rightInfo">
				<div class="kwNo"><?=$model->kwitansi?></div>
				<div class="dateInv"><?=$model->date_invoice?></div>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		<div class="containerLines">
			<table class="contentLines">
				<!-- <tr></tr> -->
			</table>
		</div>
		<div class="footers">
			<div class="amounts">
				<div class="amLine1"><?=$model->currency->name.' '.Yii::$app->numericLib->indoStyle($model->amount_untaxed)?></div>
				<div class="amLine2">&nbsp;</div>
				<div class="amLine3"><?=$model->currency->name.' '.Yii::$app->numericLib->indoStyle($model->amount_untaxed)?></div>
				<div class="amLine4"><?=$model->currency->name.' '.Yii::$app->numericLib->indoStyle($model->amount_tax)?></div>
				<div class="amLine5"><?=$model->currency->name.' '.Yii::$app->numericLib->indoStyle($model->amount_total)?></div>
			</div>
			<div class="notes">
				<div class="terb" contenteditable="true">
					<?php
					
					switch (trim($model->currency->name)) {
						case 'USD':
							# code...
							$preCur = '# United State Dollar ';
							break;
						case 'SGD':
							$preCur = '# Singapore Dollar ';
							break;
						default:
							# code...
							$preCur='';
							break;
					}
					echo $preCur;
					?>
					<?=ucwords(Yii::$app->numericLib->convertToWords($model->amount_total,$model->currency->name))?>

				</div>
				<div class="dueDate"><?=Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-m-Y")?></div>
				<div class="invFootNotes"></div>
			</div>
		</div>
	</div>
</div>

<?php
$jsonLines = \yii\helpers\Json::encode($lines);
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
EOD;
unset($jsonLines);
$this->registerJs($scr);
?>