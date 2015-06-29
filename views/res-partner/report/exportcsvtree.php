<?php
    
    $partner[]=Array("\"LT\"",
			        "\"NPWP\"",
			        "\"NAMA\"",
			        "\"JALAN\"",
			        "\"BLOK\"",
			        "\"NOMOR\"",
			        "\"RT\"",
			        "\"RW\"",
			        "\"KECAMATAN\"",
			        "\"KELURAHAN\"",
			        "\"KABUPATEN\"",
			        "\"PROPINSI\"",
			        "\"KODE_POS\"",
			        "\"NOMOR_TELEPON\"",
			    );

    foreach ($model as $value) {
        // $npwp=$value['npwp'];
        $npwp=str_replace('-','', str_replace('.','', $value['npwp']));
        $name=str_replace('"', '', $value['name']);
        $street=str_replace('"', '', $value['street']);
        $phone=str_replace('"', '', $value['phone']);
        $zip=str_replace('"', '', $value['zip']);

        $product[]=Array("\"LT\"",
			        "\"$npwp\"",
			        "\"$name\"",
			        "\"$street\"",
			        "\"BLOK\"",
			        "\"NOMOR\"",
			        "\"RT\"",
			        "\"RW\"",
			        "\"KECAMATAN\"",
			        "\"KELURAHAN\"",
			        "\"KABUPATEN\"",
			        "\"PROPINSI\"",
			        "\"$zip\"",
			        "\"$phone\"",
			    );
    }

$array_to_csv =$product;

app\components\NumericLib::convert_to_csv($array_to_csv, 'producttree.csv', ',');