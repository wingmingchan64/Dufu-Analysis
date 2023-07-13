<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\字→平水韻韻部.php 居
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_韻部 );

checkARGV( $argv, 2, 提供單字 );
$字 = trim( $argv[ 1 ] );

if( array_key_exists( $字, $字_韻部 ) )
{
	print_r( $字_韻部[ $字 ] );
}
else
{
	echo 無結果, NL;
}
?>