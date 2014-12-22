<?php
	use yii\db\Query;
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
			if($account == "False"){
				foreach ($data as $value) {
					echo '<tr>';
							$accquery = new Query;
							$accquery
								->select('code , name')
								->from('account_account')
								->where(['id' => $value['account_id']]);
							$res=$accquery->one();
							echo '<td>'.$res['code'].'</td>';
							echo '<td colspan="6">'.$res['name'].'</td>';
					echo '</tr>';

					$queryline = new Query;
		     		$queryline
		     		->select ('aml.ref as ref, aml.name as name ,aml.date as date, aml.debit as debit, aml.credit as credit')
		     		->from('account_move_line aml')
		     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
		     		->where(['>=','aml.date',$from])
		     		->andWhere(['<=','aml.date',$to])
					->andWhere(['am.state'=>'posted'])
					->andWhere(['aml.account_id'=>$value['account_id']])
					->addOrderBy(['aml.date' => SORT_ASC]);

					$lines=$queryline->all();

					$debit=0;
					$credit=0;

					foreach ($lines as $line) {
						echo '<tr>
								<td></td>
								<td>'.$line['name'].'</td>
								<td>'.Yii::$app->formatter->asDatetime($line['date'], "php:d-m-Y").'</td>
								<td>'.$line['ref'].'</td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($line['debit'],0,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($line['credit'],0,',','.').'</div></td>
								<td></td>
							 </tr>';
						$debit=$debit+$line['debit'];
						$credit=$credit+$line['credit'];
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
			}else{
				echo '<tr>';
							$accquery = new Query;
							$accquery
								->select('code , name')
								->from('account_account')
								->where(['id' => $account]);
							$res=$accquery->one();
							echo '<td>'.$res['code'].'</td>';
							echo '<td colspan="6">'.$res['name'].'</td>';
				echo '</tr>';

				$queryline = new Query;
		     		$queryline
		     		->select ('aml.ref as ref, aml.name as name ,aml.date as date, aml.debit as debit, aml.credit as credit')
		     		->from('account_move_line aml')
		     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
		     		->where(['>=','aml.date',$from])
		     		->andWhere(['<=','aml.date',$to])
					->andWhere(['am.state'=>'posted'])
					->andWhere(['aml.account_id'=>$account])
					->addOrderBy(['aml.date' => SORT_ASC]);

					$lines=$queryline->all();

					$debit=0;
					$credit=0;

					foreach ($lines as $line) {
						echo '<tr>
								<td></td>
								<td>'.$line['name'].'</td>
								<td>'.Yii::$app->formatter->asDatetime($line['date'], "php:d-m-Y").'</td>
								<td>'.$line['ref'].'</td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($line['debit'],0,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($line['credit'],0,',','.').'</div></td>
								<td></td>
							 </tr>';
						$debit=$debit+$line['debit'];
						$credit=$credit+$line['credit'];
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
