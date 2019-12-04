<?php

function replace($string){
	$string = str_replace('â€¦', '', $string);
	return $string;
}

$str='romykd37: RT @indiatvnews: #SRK's Fan bagged the prestigious IIFA Award under Best Visual Effects category @IIFA IIFARocks IIFA2017 https:t.coâ€¦';

echo $str.'<br>';
echo replace($str);
?>