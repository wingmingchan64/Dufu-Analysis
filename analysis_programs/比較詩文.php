<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\比較詩文.php
*/
require_once( '常數.php' );
require_once( '函式.php' );

$text1 = file_get_contents( 杜甫資料庫 . "text1.txt" );
$text1 = preg_replace( '/〈\X+?〉/', '', $text1 );
$text2 = file_get_contents( 杜甫資料庫 . "text2.txt" );
$result = compareText( $text1, $text2 );
print_r( $result );
?>