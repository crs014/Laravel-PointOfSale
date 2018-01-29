<?php
function to_rp($number) {
	$number = number_format($number,0,".",".");
    return "Rp. ".$number; 
}
?>