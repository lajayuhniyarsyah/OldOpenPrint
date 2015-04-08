	
<?php
	$jenisreport="out";
	
		/* ============================= Print out Untuk Surat Jalan  ===========================================  */
		$headTable="
					<tr>
						<th>No</th>
						<th>Type</th>
						<th>Date</th>
						<th>No PO</th>
						<th>No doc</th>
						
						<th>No OP / LBM / PB</th>
						<th>Qty</th>
						<th>Source Loc</th>
						<th>Dest Loc</th>
						<th>Partner</th>
					</tr>
					";
		$no=1;
		$body=[];
		foreach ($data as $value) {

			if ($value['jenis']=="out" || $value['jenis']=="internal"){
				$qty='-'.$value['qty'];
			}else{
				$qty=$value['qty'];
			}

			if ($value['jenis']=="internal"){
				$no_surat=$value['no_int'];
				$no_pb=$value['ori'];
			}else if($value['jenis']=="in"){
				$no_surat=$value['ref_cus'];
				$no_pb='LBM No '.$value['lbm'];
			}else{
				$no_surat=substr($value['dn'], 0,7);
				$no_pb=substr($value['op'], 0,7);
			}
			$jenis=$value['jenis'];
			if($value['jenis']==""){
				if($value['location_id']==5){
					$jenis='Adjutsment';
				}else if($value['location_id']==53){
					$jenis='IN / Konversi';
				}else if($value['location_id']==52){
					$jenis='Out / Konversi';
				}
				// $jenis=$value['product_name'];
			}else{
				$jenis=$value['jenis'];
			}
			$body[]='<tr>
					<td>'.$no.'</td>
					<td>'.$jenis.'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['date'], "php:d-m-Y").'</td>
					<td>'.$value['no_po'].'</td>
					<td>'.$no_surat.'</td>

					<td>'.$no_pb.'</td>
					<td class=right>'.floatval($qty).'</td>
					<td>'.$value['location'].'</td>
					<td>'.$value['desc_location'].'</td>
					<td>'.$value['partner'].'</td>
				 </tr>';
		$no++;
		}

	echo '<div class="judul">'.$nameproduct.'</div>';

	echo "<table class='table table-striped table-bordered'>";
	echo $headTable;
	foreach ($body as $val) {
		echo $val;
	}
	echo "</table>";

?>