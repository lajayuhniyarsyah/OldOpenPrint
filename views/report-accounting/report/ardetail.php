<?php
	use yii\db\Query;
	$this->title = 'Report Aged &amp; Receivables Detail';
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

						<div class="judul">Aged &amp; Receivables Detail</div>
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
								<td class="head">ID#</td>
								<td class="head">Sales</td>
								<td class="head">No Po</td>
								<td class="head">Date</td>
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
							foreach ($array as $val) {
								echo '<tr>';
										echo '<td colspan="10">'.$val['partner_name'].'<br/>'.$val['street'].'</td>';
								echo '</tr>';

								$total1=0;
								$total2=0;
								$total3=0;
								$total4=0;
								$total5=0;

								foreach ($data as $value) {
								if($value['partner_id']==$val['partner_id']){
									echo '<tr class="'.$value['partner_id'].'">';
										echo '<td></td>';
										echo '<td>'.$value['kwitansi'].'</td>';
										echo '<td>'.ucfirst($value['sales_name']).'</td>';
										echo '<td>'.$value['no_po_cus'].'</td>';
										echo '<td>'.Yii::$app->formatter->asDatetime($value['date_invoice'], "php:d-m-Y").'</td>';
										echo '<td><div class="price">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</div></td>';

										// Cek Selisih Tanggal
										$d1 = date_create($date); $d2 = date_create($value['date_invoice']);
										$interval = date_diff($d1, $d2);
										$i = (int) $interval->format('%a');
										if($i<=30){
											echo '
												<td class="price" style="text-align:right;">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</td>
												<td></td>
												<td></td>
												<td></td>

												';
											$total2=$total2+$value['total'];
										}else if($i >30 AND $i<=60){
											echo '
												<td></td>
												<td class="price" style="text-align:right;">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</td>
												<td></td>
												<td></td>
												';
												$total3=$total3+$value['total'];
										}else if($i >60 AND $i<=90){
											echo '
												<td></td>
												<td></td>
												<td class="price" style="text-align:right;">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</td>
												<td></td>
												';
												$total4=$total4+$value['total'];
										}else{
											echo '
												<td></td>
												<td></td>
												<td></td>
												<td class="price" style="text-align:right;">'.app\components\NumericLib::indoStyle($value['total'],2,',','.').'</td>
												';
												$total5=$total5+$value['total'];
										}
									
									echo '</tr>';
									$total1=$total1+$value['total'];
									
								}
							}

							 echo '<tr class="bgdark">
									<td class="bgdark" colspan="5">Total</td>
									<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($total1,2,',','.').'</div></td>
									<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($total2,2,',','.').'</div></td>
									<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($total3,2,',','.').'</div></td>
									<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($total4,2,',','.').'</div></td>
									<td class="bgdark"><div class="price">'.app\components\NumericLib::indoStyle($total5,2,',','.').'</div></td>
								 </tr>';

								$grandtotal=$grandtotal+$total1;
								$totalbulan1=$totalbulan1+$total2;
								$totalbulan2=$totalbulan2+$total3;
								$totalbulan3=$totalbulan3+$total4;
								$totalbulan4=$totalbulan4+$total5;
							}
						?>

					<tr class="grandtotal">
					<th  class="grandtotal"  style="text-align:left;" colspan="5">Grand Total</th>
					<th  class="grandtotal"  style="text-align:left;"><?php 
					echo app\components\NumericLib::indoStyle($grandtotal,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php 
					echo app\components\NumericLib::indoStyle($totalbulan1,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php 
					echo app\components\NumericLib::indoStyle($totalbulan2,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php 
					echo app\components\NumericLib::indoStyle($totalbulan3,2,',','.') ?></th>
					<th  class="grandtotal"  style="text-align:left;"><?php
					 echo app\components\NumericLib::indoStyle($totalbulan4,2,',','.') ?></th>
					</tr>
					</table>
				</td>
			</tr>
		</tbody>

	</table>
</div>
