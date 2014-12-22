<?php
	use yii\db\Query;
?>
<div class="content">
		<div class="periode">PT. Supra Bakti Mandiri</div>
		<div class="font12 italic">Jln. Danau Sunter Utara Blok A No.9</div>
		<div class="font12 italic">Jakarta Utara 14350</div>
		<br/>
		<br/>

		<div class="judul">Aged Receivables [Summary]</div>
		<div class="periode"> </div>
		<table class="ReportTable">
			<tr>
				<td>Name</td>
				<td>Total Due</td>
				<td>0-30</td>
				<td>31-60</td>
				<td>61-90</td>
				<td>90+</td>
			</tr>
			<?php
				foreach ($data as $value) {
					$debit = new Query;
							$debit
							->select('sum(aml.debit)')
							->from('account_move_line as aml')
							->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
							->where(['>=','aml.date',$date])
							->where(['aml.partner_id'=>$value['partner_id']])
							->andWhere(['aml.account_id'=>56])
							->andWhere(['am.state'=>'posted']);
							$debit=$debit->scalar();

							$credit = new Query;
							$credit
							->select('sum(aml.credit)')
							->from('account_move_line as aml')
							->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
							->where(['>=','aml.date',$date])
							->where(['aml.partner_id'=>$value['partner_id']])
							->andWhere(['aml.account_id'=>56])
							->andWhere(['am.state'=>'posted']);
							$credit=$credit->scalar();

					$hasil=$debit-$credit;
					if ($hasil== 0 || $debit == 0){
					}else{
					echo '<tr>';
							echo '<td>'.$value['name'].'--'.$value['partner_id'].'</td>';
							echo '<td>'.app\components\NumericLib::indoStyle($hasil,2,',','.').'</td>';
							echo '<td>'.app\components\NumericLib::indoStyle($debit,2,',','.').'</td>';
							echo '<td>'.app\components\NumericLib::indoStyle($credit,2,',','.').'</td>';
							$tglharuskembali='2013-1-30';
							$tglkembali='2013-2-3';
							$selisih=(strtotime($tglkembali)-strtotime($tglharuskembali));
							echo "<td>Jadi selisih tanggalnya:".$selisih."</td>";
					echo '</tr>';

					}
				}
			?>
		</table>
</div>
