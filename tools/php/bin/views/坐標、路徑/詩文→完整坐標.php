<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\詩文→完整坐標.php 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$字數 = mb_strlen( $詩文 );
$陣列 = 提取數據結構( 數字對照陣列[ $字數 ] );

if( array_key_exists( $詩文, $陣列 ) )
{
	print_r( $陣列[ $詩文 ] );
}
else
{
	echo 無結果, NL;
}
?>