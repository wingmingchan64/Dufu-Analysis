<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\單字→注音.php 居
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字音 );
require_once( 杜甫資料庫 . '統一碼字_粵音.php' );

check_argv( $argv, 2, 提供單字 );
// normalize the text
$字 = fix_text( trim( $argv[ 1 ] ) );

if( array_key_exists( $字, $字音 ) )
{
	print_r( $字音[ $字 ] );
}
elseif( array_key_exists( $字, $統一碼字_粵音 ) )
{
	print_r( $統一碼字_粵音[ $字 ] );
}
else
{
	echo 無結果, NL;
}
?>