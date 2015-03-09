<?php
	use yii\db\Query;
	$this->title = 'Report Sales &amp; Receivables Journal';
?>
<div class="content">
		<div class="periode">PT. Supra Bakti Mandiri</div>
		<div class="font12 italic">Jln. Danau Sunter Utara Blok A No.9</div>
		<div class="font12 italic">Jakarta Utara 14350</div>
		<br/>
		<br/>

		<div class="judul">Sales &amp; Receivables Journal</div>
		<div class="periode"> <?php echo Yii::$app->formatter->asDatetime($from, "php:d-m-Y") ?> To <?php echo Yii::$app->formatter->asDatetime($to, "php:d-m-Y") ?></div>
		<table class="ReportTable" border="1">
			<tr>
				<td></td>
				<td>Date</td>
				<td>ID#</td>
				<td>Acc#</td>
				<td>Account Name</td>
				<td>Debit</td>
				<td>Credit</td>
				<td>Job No.</td>
			</tr>
			<?php
			$debittotal=0;
			$kredittotal=0;
			foreach ($array as $val) {
				echo '<tr>';
							echo '<td>SJ</td>';
							echo '<td>'.Yii::$app->formatter->asDatetime($val['date'], "php:d-m-Y").'</td>';
							echo '<td colspan="6">'.$val['partner_name'].'</td>';
				echo '</tr>';
				$debit=0;
				$credit=0;		
				foreach ($data as $value) {
					if($value['move_id']==$val['move_id']){
						echo '<tr>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>'.$value['kwitansi'].'</td>';
							echo '<td>'.$value['code'].'</td>';
							echo '<td>'.$value['account'].'</td>';
							echo '<td><div class="price">'.app\components\NumericLib::indoStyle($value['debit'],0,',','.').'</div></td>';
							echo '<td><div class="price">'.app\components\NumericLib::indoStyle($value['credit'],0,',','.').'</div></td>';
							echo '<td></td>';
						echo '</tr>';
						$debit=$debit+$value['debit'];
						$credit=$credit+$value['credit'];			
					}
				}
				echo '<tr class="bgdark">
					<td class="bgdark"></td>
					<td class="bgdark"></td>
					<td class="bgdark"></td>
					<td class="bgdark"></td>
					<td class="bgdark"></td>
					<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($debit,0,',','.').'</div></td>
					<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($credit,0,',','.').'</div></td>
					<td class="bgdark"></td>
				 </tr>';	
				$debittotal=$debittotal+$debit;
				$kredittotal=$kredittotal+$credit;
			}
			?>

			<tr class="grandtotal">
				<th colspan="2" class="grandtotal"></th>
				<th colspan="3" class="grandtotal"  style="text-align:left;">Grand Total</th>
				<th style="text-align:right;" class="grandtotal"><?php echo app\components\NumericLib::indoStyle($debittotal,0,',','.') ?></th>
				<th style="text-align:right;" class="grandtotal"><?php echo app\components\NumericLib::indoStyle($kredittotal,0,',','.') ?></th>
				<th></th>
			</tr>
		</table>
</div>
