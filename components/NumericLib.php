<?php

namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class NumericLib extends Component{
	function convertToWords($x)
	{
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return $this->convertToWords($x - 10) . "belas";
		elseif ($x < 100)
			return $this->convertToWords($x / 10) . " puluh" . $this->convertToWords($x % 10);
		elseif ($x < 200)
			return " seratus" . $this->convertToWords($x - 100);
		elseif ($x < 1000)
			return $this->convertToWords($x / 100) . " ratus" . $this->convertToWords($x % 100);
		elseif ($x < 2000)
			return " seribu" . convertToWords($x - 1000);
		elseif ($x < 1000000)
			return $this->convertToWords($x / 1000) . " ribu" . $this->convertToWords($x % 1000);
		elseif ($x < 1000000000)
			return $this->convertToWords($x / 1000000) . " juta" . $this->convertToWords($x % 1000000);
	}

	function indoStyle($numeric){
		return number_format($numeric,2,',','.');
	}
}
?>