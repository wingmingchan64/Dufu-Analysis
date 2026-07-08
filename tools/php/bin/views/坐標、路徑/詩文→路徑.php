<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\坐標、路徑\詩文→路徑.php 不貪夜識金銀氣
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$字數 = mb_strlen( $詩文 );
$陣列 = 提取數據結構( 數字對照陣列[ $字數 ] );
$temp = array();

if( array_key_exists( $詩文, $陣列 ) )
{
	foreach( $陣列[ $詩文 ] as $坐標 )
	{
		$temp[] = implode( ',', 完整坐標轉換成路徑列陣( $坐標 ) );
	}
	print_r( $temp );
}
else
{
	echo 無結果, NL;
}
?>