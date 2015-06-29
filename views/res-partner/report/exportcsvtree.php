<?php
    $customer[]=Array("LT",
			        "NPWP",
			        "NAMA",
			        "JALAN",
			        "BLOK",
			        "NOMOR",
			        "RT",
			        "RW",
			        "KECAMATAN",
			        "KELURAHAN",
			        "KABUPATEN",
			        "PROPINSI",
			        "KODE_POS",
			        "NOMOR_TELEPON",
			    );

    foreach ($model as $value) {
    	$npwp=str_replace('-','', str_replace('.','', $value['npwp']));
        $name=str_replace('"', '', $value['name']);
        $street=str_replace('"', '', $value['street']);
        $phone=str_replace('"', '', $value['phone']);
        $zip=str_replace('"', '', $value['zip']);

        $customer[]=Array("LT",
			        "$npwp",
			        "$name",
			        "$street",
			        "BLOK",
			        "NOMOR",
			        "RT",
			        "RW",
			        "KECAMATAN",
			        "KELURAHAN",
			        "KABUPATEN",
			        "PROPINSI",
			        "$zip",
			        "$phone",
			);
    }

$array_to_csv =$customer;
app\components\ExportCSV::convert_to_csv($array_to_csv, 'customertree.csv', ',');