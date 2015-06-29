<?php
$default_code=$model->default_code;
$name_template=str_replace('"', '', $model->name_template);
$array_to_csv = Array(
	Array("ob",
        "default_code",
        "name",
        "price",
    ),
    Array("OB",
        "$default_code",
        "$name_template",
        "1.0",
    ),

);

app\components\ExportCSV::convert_to_csv($array_to_csv, 'product.csv', ',');