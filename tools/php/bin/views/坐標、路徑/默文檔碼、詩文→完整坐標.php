<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\默文檔碼、詩文→完整坐標.php 1376 死
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 3, 提供默文檔碼、詩文 );
$默文檔碼 = 修復文檔碼( trim( $argv[ 1 ] ) );
$詩文 = fix_text( trim( $argv[ 2 ] ) );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo "此文檔碼不存在。", NL;
}

$字數 = mb_strlen( $詩文 );
$陣列 = 提取數據結構( 數字對照陣列[ $字數 ] );
$result = array();

if( array_key_exists( $詩文, $陣列 ) )
{
	$標s = $陣列[ $詩文 ];
	foreach( $標s as $標 )
	{
		if( mb_substr( $標, 1, 4 ) == $默文檔碼 )
		{
			array_push( $result, $標 );
		}
	}
	print_r( $result );
}
else
{
	echo 無結果, NL;
}
?>