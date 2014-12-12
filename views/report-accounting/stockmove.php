	
<?php
	$jenisreport="out";
	
	if($jenis=="del"){
		/* ============================= Print out Untuk Surat Jalan  ===========================================  */
		$judul= "<div class='judul'>Report Delivery Note</div> <br/> <div class='periode'> ".Yii::$app->formatter->asDatetime($from, "php:d-m-Y")." s/d ".Yii::$app->formatter->asDatetime($to, "php:d-m-Y")."</div>";	
		$headTable="
					<tr>
						<td>No</td>
						<td>Date</td>
						<td>DN</td>
						<td>OP</td>
						<td>Part Number</td>
						<td>Product Name</td>
						<td>Product Desc</td>
						<td>Qty</td>
						<td>UOM</td>
						<td>Batch</td>
						<td>Price</td>
						<td>Currency</td>
						<td>SO</td>
						<td>PO</td>
						<td>Customer</td>
						<td>Status</td>
					</tr>
					";
		$no=1;
		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$no.'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['tanggal'], "php:d-m-Y").'</td>
					<td>'.substr($value['dn_no'], 1,6).'</td>
					<td>'.substr($value['no_op'], 1,6).'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.app\components\NumericLib::indoStyle($value['price'],2,',','.').'</td>
					<td>'.$value['pricelist'].'</td>
					<td>'.substr($value['so_no'], 9,5).'</td>
					<td>'.$value['poc'].'</td>
					<td>'.$value['partner'].'</td>
					<td>'.$value['state'].'</td>
				 </tr>';
		$no++;
		}
	}else{
		/* ============================= Print out Untuk Incoming Shipment & Internal Move  ===========================================  */
		$judul= "<div class='judul'>Report Incoming Shipment &amp; Internal Move</div> <br/><div class='periode'>  ".Yii::$app->formatter->asDatetime($from, "php:d-m-Y")." s/d ".Yii::$app->formatter->asDatetime($to, "php:d-m-Y")."</div>";
		$headTable="
			<tr>
				<td>Type</td>
				<td>Date</td>
				<td>LBM No</td>
				<td>Part Number</td>
				<td>Product Name</td>
				<td>Product Desc</td>
				<td>Qty</td>
				<td>UOM</td>
				<td>Batch</td>
				<td>Price</td>
				<td>Currency</td>
				<td>Location</td>
				<td>Dest Location</td>
				<td>Partner</td>
				<td>Type</td>
				<td>NO PO</td>
				<td>Origin</td>
				<td>Status</td>
			</tr>
			";
		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$value['jenis'].'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['date_done'], "php:d-m-Y").'</td>
					<td>'.$value['lbm'].'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.app\components\NumericLib::indoStyle($value['price'],2,',','.').'</td>
					<td>'.$value['pricelist'].'</td>
					<td>'.$value['location'].'</td>
					<td>'.$value['desc_location'].'</td>
					<td>'.$value['partner'].'</td>
					<td>'.$value['type'].'</td>
					<td>'.$value['po'].'</td>
					<td>'.$value['origin'].'</td>
					<td>'.$value['state'].'</td>
				 </tr>';
		}

	}

	echo $judul;
	echo "<table class='ReportTable'>";
	echo $headTable;
	foreach ($body as $val) {
		echo $val;
	}
	echo "</table>";

?>