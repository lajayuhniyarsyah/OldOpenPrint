<?php

$npwp=str_replace('-','', str_replace('.','', $model->npwp));
$name=str_replace('"', '', $model->name);
$street=str_replace('"', '', $model->street);
$phone=str_replace('"', '', $model->phone);
$zip=str_replace('"', '', $model->zip);
$array_to_csv = Array(
	Array("LT",
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
    ),
    Array("LT",
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
    ),

);


// $array_to_csv = Array(
//     Array("\"LT\"",
//         "\"NPWP\"",
//         "\"NAMA\"",
//         "\"JALAN\"",
//         "\"BLOK\"",
//         "\"NOMOR\"",
//         "\"RT\"",
//         "\"RW\"",
//         "\"KECAMATAN\"",
//         "\"KELURAHAN\"",
//         "\"KABUPATEN\"",
//         "\"PROPINSI\"",
//         "\"KODE_POS\"",
//         "\"NOMOR_TELEPON\"",
//     ),
//     Array("\"LT\"",
//         "\"$npwp\"",
//         "\"$name\"",
//         "\"$street\"",
//         "\"BLOK\"",
//         "\"NOMOR\"",
//         "\"RT\"",
//         "\"RW\"",
//         "\"KECAMATAN\"",
//         "\"KELURAHAN\"",
//         "\"KABUPATEN\"",
//         "\"PROPINSI\"",
//         "\"$zip\"",
//         "\"$phone\"",
//     ),

// );
app\components\ExportCSV::convert_to_csv($array_to_csv, 'customer.csv', ',');