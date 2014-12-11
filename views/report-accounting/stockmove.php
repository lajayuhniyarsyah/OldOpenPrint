	
<?php
	$jenisreport="out";
	
	if($jenis=="del"){
		/* ============================= Print out Untuk Surat Jalan  ===========================================  */
		$judul= "REPORT SURAT JALAN";	
		$headTable="
					<tr>
						<th>Create Date</th>
						<th>Delivery Date</th>
						<th>NO Delivery Note</th>
						<th>No OP</th>
						<th>Part Number</th>
						<th>Product Name</th>
						<th>Product Desc</th>
						<th>Qty</th>
						<th>UOM</th>
						<th>Batch</th>
						<th>Price</th>
						<th>Currency</th>
						<th>SO NO</th>
						<th>PO NO</th>
						<th>Customer</th>
						<th>Status</th>
					</tr>
					";

		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$value['cretae_date'].'</td>
					<td>'.$value['tanggal'].'</td>
					<td>'.$value['dn_no'].'</td>
					<td>'.$value['no_op'].'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.$value['price'].'</td>
					<td>'.$value['pricelist'].'</td>
					<td>'.$value['so_no'].'</td>
					<td>'.$value['poc'].'</td>
					<td>'.$value['partner'].'</td>
					<td>'.$value['state'].'</td>
				 </tr>';
		}
	}else{
		/* ============================= Print out Untuk Incoming Shipment & Internal Move  ===========================================  */
		$judul= "REPORT INCOMING SHIPMENT DAN INTERNAL MOVE";
		$headTable="
			<tr>
				<th>Type</th>
				<th>Date Done</th>
				<th>LBM No</th>
				<th>Part Number</th>
				<th>Product Name</th>
				<th>Product Desc</th>
				<th>Qty</th>
				<th>UOM</th>
				<th>Batch</th>
				<th>Price</th>
				<th>Currency</th>
				<th>Location</th>
				<th>Dest Location</th>
				<th>Partner</th>
				<th>Type</th>
				<th>NO PO</th>
				<th>Origin</th>
				<th>Status</th>
			</tr>
			";
		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$value['jenis'].'</td>
					<td>'.$value['date_done'].'</td>
					<td>'.$value['lbm'].'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.$value['price'].'</td>
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

	echo "<center>".$judul."</center>";
	echo "<table class='table table-striped table-hover'>";
	echo $headTable;
	foreach ($body as $val) {
		echo $val;
	}
	echo "</table>";

?>