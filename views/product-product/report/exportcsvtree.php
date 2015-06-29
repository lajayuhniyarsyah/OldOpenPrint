<?php
    
    $product[]=Array("ob","default_code","name","price");

    foreach ($model as $value) {
        $default_code=$value['default_code'];
        $name_template=str_replace('"', '', $value['name_template']);

        $product[]=Array("OB","$default_code","$name_template","1.0");
    }

$array_to_csv =$product;

app\components\ExportCSV::convert_to_csv($array_to_csv, 'producttree.csv', ',');