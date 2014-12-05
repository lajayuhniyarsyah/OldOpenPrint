<style type="text/css">
	#container
	{
		width: 190mm;
		/*border: 1px solid black;*/
		padding-left: 10mm;
		vertical-align: top;
		font-family: Arial, Helvetica, sans-serif;

	}
	.pages
	{
		padding-top: 37mm;
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
		height: 65mm;
	}
	.attnTo
	{
		float: left;
		width: 39%;
		padding-top: 11mm;
		font-size: 11pt;
	}

	.partnerName
	{
		font-size: 12pt;
	}
	.tdLines
	{
		min-height: 134mm;
		/*border-bottom: 1px solid blue;*/
		font-size: 11pt;
		padding-top: 9mm;
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
	.clear{
		clear: both;
		height: 0mm;
	}
	.urgentCode{
		font-size: 46pt;
		font-weight: bold;
		float: right;
		margin-right: 10mm;
	}
	@media print
	{
		#container{
			border: none;
		}
	}
	pre{
		font-family: Arial, Helvetica, sans-serif;
	}
</style>

<?php
if(Yii::$app->request->getQueryParam('uid') == 23):
	?>
	<style type="text/css">
	.attnTo{
		padding-top: 5mm;
		font-size: 10pt;
	}
	.dnNo{
		padding-top: 4%;
		font-size: 10pt;
	}
	.opNo{
		padding-left: 64% !important;
		margin-top: 6% !important;
		font-size: 10pt;
	}
	.poc{
		margin-top: 6% !important;
		font-size: 10pt;
	}
	.headers{
		height: 50mm !important;
	}
	.tdLines{
		min-height: 110mm;
		font-size: 10pt !important;
		padding-top: 5mm;
	}
	</style>
<?php
endif;
?>
<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="attnTo">
				<p class="partnerName"><?=$model->partner->name?></p>
				<p contenteditable="true">
					<?=$model->partnerShipping->street?>
					<?=($model->partnerShipping->street2 ? '<br/>'.$model->partnerShipping->street2:null)?>
					<br/><?=$model->partnerShipping->city?>
					 <?=(isset($model->partnerShipping->country->name) ? ' - '.$model->partnerShipping->country->name:false)?>
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
				<div class="dnNo">
					<div class="urgentCode" contenteditable="true">
						<?php
							if(isset($model->packingListLines[0])){
								echo $model->packingListLines[0]->urgent;
							}else{
								echo 'L9';
							}
						?>
					</div>
					<?=$model->name?>

				</div>
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
			<div class="clear"></div>
		</div>
		<div class="clear">&nbsp;</div>
		
		<div class="tdLines">
			<table class="contentLines" style="width:100%;">
				<tr>
					
				</tr>
			</table>
		</div>
	</div>
</div>


<?php
$scr = '
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
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:23%;\">"+data.qty+"</td><td contenteditable=\"true\" style=\"width:57%\">"+data.name+"</td><td style=\"text-align:center;\">"+data.part_no+"</td></tr>";
	}

	function getNotes(notes,rowNo=999999)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:23%;\"></td><td contenteditable=\"true\" style=\"width:57%;padding-top:10mm;\">Notes : <br/><pre>"+notes+"</pre></td><td></td></tr>";
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
			// jQuery(\'.pager:last\').html(currPage);
			// console.log(tmpl);
			
		}
		
		console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
		currRow=currRow+1;
	});
	// end loop
	
	

';

$this->registerJs($scr);

if($model->terms){
	$scr2='jQuery(\'.contentLines tr:last\').after(getNotes(\''.preg_replace('/\n/', '', nl2br($model->terms)).'\'));
	currLineHeight = jQuery(\'#tdLine\'+currPage).height();
	console.log(currLineHeight);
	if(currLineHeight>maxLinesHeight){
		// remove last row
		var notes = jQuery(\'#lines\'+currPage+\' tr:last\')
		var notesHtml = notes.html();
		notes.remove();
		// add new page container
		jQuery(\'div#page\'+currPage).after(tmpl);
		console.log(\'div#page\'+currPage);
		currPage = currPage+1;
		console.log(currPage);
		// add id to new div
		jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
		jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
		jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

		jQuery(\'#lines\'+currPage).html(notes);
		currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		// jQuery(\'.pager:last\').html(currPage);
		// console.log(tmpl);
		
	}';
	$this->registerJs($scr2);
}

?>