<style type="text/css">
	#container
	{
		width: 190mm;
		/*border: 1px solid black;*/
		padding-left: 13mm;
		vertical-align: top;
		font-family: Arial, Helvetica, sans-serif;

	}
	.pages
	{
		padding-top: 60mm;
		page-break-after: always;
		height: 240mm;
		/*border-bottom: 1px solid red;*/
	}
	.pager
	{
		margin-top: 88mm;
		margin-left: 181mm;
	}

	.headers
	{
		
		/*border-bottom: 1px solid black;*/
		height: 75mm;
		padding-left: 25mm;
	}
	.hLine{
		height: 7mm;
	}
	.attnTo
	{
		/*float: left;*/
		width: 43%;
		padding-top: 11mm;
		font-size: 11pt;
	}

	.partnerName
	{
		font-size: 12pt;
	}
	.tdLines
	{
		min-height: 122mm;
		border-bottom: 1px solid blue;
		font-size: 10pt;
	}
	.contentLines tr td{
		vertical-align: top;
	}
	.dnInfo
	{
		/*float: right;*/

	}
	.dnNo
	{
		font-size: 12pt;
		padding-top: 5%;
		padding-left: 51%;
	}
	.opNo
	{
		margin-top: 9%;
		padding-left: 61%;
		font-size: 12pt;

	}
	.poc
	{
		margin-top: 8%;
		padding-left: 49%;
		font-size: 12pt;
	}
	.pagesInfo{
		margin-left: 100mm;

	}

	.td1{
		width: 21mm;
	}
	.td2{
		width: 17mm;
	}
	.td3{
		width: 90mm;
	}
	.td4{
		width: 15mm;
	}
	.td5{
		width: 15mm;
	}


	.footers .totalItem{
		width: 44mm;
		float: left;
	}
	.footers .totalBox{
		width: 87mm;
		height: 14mm;
		text-align: center;
		float: left;
	}
	.footers .totalWeight{
		float: left;
	}
	.clear{
		clear: both;
	}
	.POInfo{
		padding-left: 50mm;
	}
	@media print
	{
		#container{
			border: none;
		}
	}
</style>
<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="attnTo">
				
			</div>
			<div class="pageInfo">
				<div class="to hLine"><?=$model->partner->name?></div>
				<div class="attn hLine"><?=$model->partnerShipping->name?></div>
				<div class="date hLine"><?=$model->tanggal?></div>
				<div class="ref hLine"><?=$model->name?></div>
				<div class="pagesInfo">
					<div class="boxInfo"></div>
					<div class="pageNo"></div>
				</div>
			</div>
		</div>
		<div class="tdLines">
			<table class="contentLines">
				
			</table>
		</div>
		<div class="footers">
			<div class="totalRow">
				<div class="totalItem"></div>
				<div class="totalBox"></div>
				<div class="totalWeight"></div>
				<div class="clear"></div>
			</div>
			<div class="POInfo">
				Purchase Order No. <?=$model->poc?>
				<?=$model->note?>
			</div>
			<div class="sign"></div>
		</div>
	</div>
</div>

<?php

$scr = '
	function pad (str, max) {
		str = str.toString();
		return str.length < max ? pad("0" + str, max) : str;
	}
	var currPage = 1;
	var pagesData = '.\yii\helpers\Json::encode($pagesData).';
	// console.log(pagesData);

	// save page template to var
	var tmpl = jQuery(\'div#container\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	var currRow = 0;
	//console.log(maxLinesHeight);
	var rowPage = 0;

	function prepareRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td class=\'td1\'>"+data.no+"</td><td class=\'td2\'>"+data.qty+"</td><td class=\'td3\'>"+data.desc+"</td><td class=\'td4\'>"+data.weight+"</td><td style=\"text-align:center;\" class=\'td5\'>"+data.measurement+"</td></tr>";
	}
	var totalPageBox = [];
	var packData = [];
	jQuery.each(pagesData,function(packQue,pageData){
		packData[packQue] = [];
		if(!totalPageBox[packQue])
		{
			totalPageBox[packQue] = 0;
		}
		packData[packQue][\'len\'] = pageData.lines.length;
		console.log(pageData.totalWeight);
		var pagePerbox=1;
		jQuery.each(pageData.lines,function(n,line)
		{
			var getRow = prepareRow(currRow,line);
			//console.log(\'Printting Box \'+packQue+\' in page \'+currPage+\' line \'+n+\' for \'+line.product);
			if(packQue==0)
			{
				// if first pack
				if(n==0)
				{
					// if first item on first pack
					jQuery(\'#lines\'+currPage).html(getRow);
				}
				else
				{
					jQuery(\'#lines\'+currPage+\' tr:last\').after(getRow);
				}
			}
			else{

				// put new printing page for new pack
				if(n==0){
					// if first item in next pack
					jQuery(\'div#page\'+currPage).after(tmpl);
					// console.log(\'div#page\'+currPage);
					currPage = currPage+1;
					// console.log(currPage);
					// add id to new div
					jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
					jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
					jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
					jQuery(\'#lines\'+currPage).html(getRow);
				}else{
					jQuery(\'#lines\'+currPage+\' tr:last\').after(getRow);
				}
			}

			var currLinesHeight = jQuery(\'.tdLines:last\').height();
			// console.log(\'current height : \'+currLinesHeight);

			if(maxLinesHeight < currLinesHeight)
			{
				// remove last row
				jQuery(\'#lines\'+currPage+\' tr:last\').remove();
				// add new page container
				jQuery(\'div#page\'+currPage).after(tmpl);
				// console.log(\'div#page\'+currPage);
				currPage = currPage+1;
				pagePerbox = pagePerbox+1;
				// console.log(currPage);
				// add id to new div
				jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
				jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
				jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

				jQuery(\'#lines\'+currPage).html(getRow);
				currLineHeight = jQuery(\'#tdLine\'+currPage).height();
				// jQuery(\'.pager:last\').html(currPage);
				// console.log(tmpl);
			}
			jQuery(\'#page\'+currPage+\' .pagesInfo .boxInfo\').html(\'BOX \'+pad(packQue+1,2)+\' of \'+pad(pagesData.length,2));
			jQuery(\'#page\'+currPage+\' .pagesInfo .pageNo\').html(\'P. \'+pad(pagePerbox,2)+\' of <span class="pageTotalInfo\'+packQue+\'"></span>\');
			rowPage = rowPage+1;
			currRow=currRow+1;
			totalPageBox[packQue] = pagePerbox;
			jQuery(\'.footers:last .totalRow .totalItem\').html(\'Total : \'+pageData.lines.length+\' Items\');
			jQuery(\'.footers:last .totalRow .totalBox\').html(\'TOTAL : 1 BOX\');
			jQuery(\'.footers:last .totalRow .totalWeight\').html(\'Total : \'+pageData.totalWeight);


			jQuery(\'.footers:last .totalRow .totalItem\').attr(\'class\',\'totalItem totalItem\'+packQue);
			jQuery(\'.footers:last .totalRow .totalBox\').attr(\'class\',\'totalBox totalBox\'+packQue);
			jQuery(\'.footers:last .totalRow .totalWeight\').attr(\'class\',\'totalweight totalWeight\'+packQue);



			
		});
	});
	// console.log(totalPageBox);
	jQuery.each(totalPageBox,function(i,v){
		jQuery(\'.pageTotalInfo\'+i).html(pad(v,2));
	});
	console.log(packData);
	jQuery(\'.pageTotalInfo\').html(pad(currPage,2));
';

$this->registerJs($scr);

?>