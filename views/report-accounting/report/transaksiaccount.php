<?php
	use yii\db\Query;
	$this->title = 'Report Account Transactions [Accrual]';
?>

<div class="content">
		<div class="periode">PT. Supra Bakti Mandiri</div>
		<div class="font12 italic">Jln. Danau Sunter Utara Blok A No.9</div>
		<div class="font12 italic">Jakarta Utara 14350</div>
		<br/>
		<br/>
		<div class="judul">Account Transactions [Accrual]</div>
		<div class="periode"> <?php echo Yii::$app->formatter->asDatetime($from, "php:d-m-Y") ?> To <?php echo Yii::$app->formatter->asDatetime($to, "php:d-m-Y") ?></div>
		<table class="ReportTable">
			<tr>
				<td>#</td>
				<td>ID#</td>
				<td>Date</td>
				<td>Memo/Payee</td>
				<td>Debit</td>
				<td>Credit</td>
				<td>Job No.</td>
			</tr>
			<?php
			foreach ($array as $val) {
				echo '<tr>';
							echo '<td>'.$val['code'].'</td>';
							echo '<td colspan="6">'.$val['account_name'].'</td>';
				echo '</tr>';
				$debit=0;
				$credit=0;		
				foreach ($data as $value) {
					if($value['account_id']==$val['account_id']){
						echo '<tr>';
							echo '<td></td>';
							echo '<td>'.$value['name'].'</td>';
							echo '<td>'.Yii::$app->formatter->asDatetime($value['date'], "php:d-m-Y").'</td>';
							echo '<td>'.$value['ref'].'</td>';
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
					<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($debit,0,',','.').'</div></td>
					<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($credit,0,',','.').'</div></td>
					<td class="bgdark"></td>
				 </tr>';	
			}
			?>
		</table>
</div>
