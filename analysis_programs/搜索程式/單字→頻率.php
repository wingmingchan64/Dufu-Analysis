<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\單字→頻率.php 居
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 用字_頻率 );

checkARGV( $argv, 2, 提供單字 );
$字 = trim( $argv[ 1 ] );

if( array_key_exists( $字, $用字_頻率 ) )
{
	echo NL, "'${字}'字頻率：";
	print_r( $用字_頻率[ $字 ] );
	echo NL;
}
else
{
	echo 無結果, NL;
}
?>