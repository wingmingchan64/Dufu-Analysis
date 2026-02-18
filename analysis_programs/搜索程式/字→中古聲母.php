<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\字→中古聲母.php 居
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_聲母 );

check_argv( $argv, 2, 提供單字 );
// standardize the text
$字 = fix_text( trim( $argv[ 1 ] ) );

if( array_key_exists( $字, $字_聲母 ) )
{
	print_r( $字_聲母[ $字 ] );
}
else
{
	echo 無結果, NL;
}
?>