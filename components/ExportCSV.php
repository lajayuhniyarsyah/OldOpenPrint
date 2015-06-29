<?php

namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class ExportCSV extends Component{
	public function convert_to_csv($input_array, $output_file_name, $delimiter)
	{
	    /** open raw memory as file, no need for temp files, be careful not to run out of memory thought */
	    $f = fopen('php://memory', 'w');
	    /** loop through array  */
	    foreach ($input_array as $line) {
	        /** default php csv handler **/
	        fputcsv($f, $line, $delimiter);
	    }
	    
	    fseek($f, 0);
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
	    fpassthru($f);
	}
}
?>