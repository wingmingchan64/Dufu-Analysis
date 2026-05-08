<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\句→路徑.php 無成涕作霖
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩句 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );

$句_路徑 = 提取數據結構( 句_路徑 );

if( array_key_exists( $詩文, $句_路徑 ) )
{
	print_r( $句_路徑[ $詩文 ] );
	return;
}

$fragment_paths = array();

foreach( $句_路徑 as $句 => $路徑 )
{
	if( strpos( $句, $詩文 ) !== false )
	{
		$fragment_paths = 
			array_unique( 
				array_merge( $fragment_paths, $路徑 ) );
	}
}

if( count( $fragment_paths ) )
{
	print_r( $fragment_paths );
}
else
{
	echo 無結果, NL;
}
?>