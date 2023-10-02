<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\詩組數字.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 詩組_詩題 );

echo sizeof( $詩組_詩題 ), NL;
$total = 0;

foreach( $詩組_詩題 as $頁 => $item )
{
	$total += sizeof( $item[ 1 ] );
}
echo $total, NL;

?>