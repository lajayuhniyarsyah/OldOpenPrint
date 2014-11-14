<style type="text/css">
	#container
	{
		width: 190mm;
		border: 1px solid black;
		padding-left: 8mm;
		vertical-align: top;
	}
	.pages
	{
		padding-top: 37mm;
		page-break-after: always;
		height: 295mm;
		border-bottom: 1px solid red;
	}
	.pager
	{
		margin-top: 88mm;
		margin-left: 181mm;
	}

	.headers
	{
		
		/*border-bottom: 1px solid black;*/
		height: 67mm;
	}
	.attnTo
	{
		float: left;
		width: 43%;
		padding-top: 11mm;
	}

	.partnerName
	{
		font-size: larger;
	}
	.tdLines
	{
		min-height: 134mm;
		border-bottom: 1px solid blue;
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
		font-size: larger;
		padding-top: 5%;
		padding-left: 51%;
	}
	.opNo
	{
		margin-top: 9%;
		padding-left: 61%;
	}
	.poc
	{
		margin-top: 8%;
		padding-left: 49%;
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
				<p class="partnerName"><?=$model->partner->name?></p>
				<p>
					<?=$model->partnerShipping->street?>
					<?=($model->partnerShipping->street2 ? '<br/>'.$model->partnerShipping->street2:null)?>
					<br/><?=$model->partnerShipping->city?>
					 - <?=$model->partnerShipping->country->name?>
					 <br/><?=$model->partnerShipping->zip?>
					 <br/>Phone : <?=$model->partnerShipping->phone?>
					 <?php
					 	if($model->partnerShipping->mobile):
					 		echo '<br/>Mobile :'.$model->partnerShipping->mobile;
					 	endif;
					 ?>
				</p>
			</div>
			<div class="dnInfo">
				<div class="dnNo"><?=$model->name?></div>
				<div class="opNo">
					<?php
						$fullOp=$model->prepare->name;
						$explOp = explode('/', $fullOp);
						echo $explOp[0];
					?>
				</div>
				<div class="poc">
					<?=$model->poc?>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		
		<div class="tdLines">
			<table class="contentLines">
				<tr>
					<td>Jumlah</td>
					<td>Jenis Barang</td>
					<td>Part No</td>
				</tr>
			</table>
		</div>
	</div>
</div>


<?php
$this->registerJs('
	var currPage = 1;

	// save page template to var
	var tmpl = jQuery(\'div#container\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($linesData).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:23%;\">"+data.qty+"</td><td style=\"width:58%\">"+data.name+"</td><td style=\"text-align:center;\">"+data.part_no+"</td></tr>";
	}

	function printNotes(rowNo,data)
	{

	}
	var rowPage = 0;
	jQuery.each(lines,function(key,line){
		var getRow = prepareRow(currRow,line);
		if(key==0)
		{
			jQuery(\'#lines\'+currPage).html(getRow);
		}
		else
		{
			jQuery(\'#lines\'+currPage+\' tr:last\').after(getRow);
		}
		rowPage = rowPage+1;

		var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'#lines\'+currPage+\' tr:last\').remove();
			// add new page container
			jQuery(\'div#page\'+currPage).after(tmpl);
			console.log(\'div#page\'+currPage);
			currPage = currPage+1;
			console.log(currPage);
			// add id to new div
			jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
			jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
			jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

			jQuery(\'#lines\'+currPage).html(getRow);
			currLineHeight = jQuery(\'#tdLine\'+currPage).height();
			jQuery(\'.pager:last\').html(currPage);
			// console.log(tmpl);
			
		}

		console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
		currRow=currRow+1;
	});
	// end loop
');
?>