<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默文檔碼→重現名單.php 356
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無文檔碼, NL;
}
$詩文重見名單 = 提取數據結構( 默認詩文檔碼_詩文重見名單 );

if( !array_key_exists( $默文檔碼, $詩文重見名單 ) )
{
	echo "「${默文檔碼}」無重見名單。";
}
else
{
	print_r( implode( ',', $詩文重見名單[ $默文檔碼 ] ) );
}

?>