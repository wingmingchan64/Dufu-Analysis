<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\單字→詩句.php 居
客居所居堂
卜居赤甲遷居新
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 用字_詩句 );

checkARGV( $argv, 2, 提供單字 );
$字 = trim( $argv[ 1 ] );

if( array_key_exists( $字, $用字_詩句 ) )
{
	echo NL, "包含'${字}'字的詩句：", NL;
	print_r( $用字_詩句[ $字 ] );
}
else
{
	echo 無結果, NL;
}
?>