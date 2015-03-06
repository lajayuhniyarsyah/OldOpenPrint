<?php
	use yii\db\Query;
	$this->title = 'Report Account Transactions [Accrual]';
?>

<div class="content">

	<table style="width:100%;">
	<thead>
		<tr>
			<td>
				<div class="periode">PT. Supra Bakti Mandiri</div>
				<div class="font12 italic">Jln. Danau Sunter Utara Blok A No.9</div>
				<div class="font12 italic">Jakarta Utara 14350</div>
				<br/>
				<br/>
				<div class="judul">Account Transactions [Accrual]</div>
				<div class="periode"> <?php echo Yii::$app->formatter->asDatetime($from, "php:d-m-Y") ?> To <?php echo Yii::$app->formatter->asDatetime($to, "php:d-m-Y") ?></div>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table class="ReportTable">
					<thead>
						<tr class="head">
							<td class="head">#</td>
							<td class="head">ID#</td>
							<td class="head">Date</td>
							<td class="head">Memo/Payee</td>
							<td class="head">Debit</td>
							<td class="head">Credit</td>
							<td class="head">Job No.</td>
						</tr>
					</thead>
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
			</td>
		</tr>
	</tbody>

	</table>
</div>
