<?php
	use yii\db\Query;
	$this->title = 'Report Aged Payables Summary';
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

						<div class="judul">Aged Payables Summary</div>
						<div class="periode"> <?php echo Yii::$app->formatter->asDatetime($date, "php:d-m-Y") ?> </div>
					</td>
				</tr>
			</thead>
		<tbody>
			<tr>
				<td>
					<table class="ReportTable" border="1">
					<thead>
						<tr class="head">
							<td class="head">Name</td>
							<td class="head">Total Due</td>
							<td class="head">0-30</td>
							<td class="head">31-60</td>
							<td class="head">61-90</td>
							<td class="head">90+</td>
						</tr>
					</thead>
						<?php
						$grandtotal=0;
						$totalbulan1=0;
						$totalbulan2=0;
						$totalbulan3=0;
						$totalbulan4=0;
						
						foreach ($data as $value) {
							echo '<tr>
								<td>'.$value['partner'].'</td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($value['debit30'],2,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($value['debit60'],2,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($value['debit90'],2,',','.').'</div></td>
								<td><div class="price">'.app\components\NumericLib::indoStyle($value['debit90lebih'],2,',','.').'</div></td>
								
							 </tr>';
						$grandtotal=$grandtotal+$value['total'];
						$totalbulan1=$totalbulan1+$value['debit30'];
						$totalbulan2=$totalbulan2+$value['debit60'];
						$totalbulan3=$totalbulan3+$value['debit90'];
						$totalbulan4=$totalbulan4+$value['debit90lebih'];
						}
						
						?>

					<tr class="grandtotal">
					<th  class="grandtotal"  style="text-align:left;">Grand Total</th>
					<th  class="grandtotal"  style="text-align:left;"><?php echo app\components\NumericLib::indoStyle($grandtotal,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php echo app\components\NumericLib::indoStyle($totalbulan1,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php echo app\components\NumericLib::indoStyle($totalbulan2,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php echo app\components\NumericLib::indoStyle($totalbulan3,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php echo app\components\NumericLib::indoStyle($totalbulan4,2,',','.') ?></th>
					
					</tr>
					</table>
				</td>
			</tr>
		</tbody>

	</table>
</div>
