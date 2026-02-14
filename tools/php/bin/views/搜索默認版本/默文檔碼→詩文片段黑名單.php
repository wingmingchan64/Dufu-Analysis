<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默文檔碼→詩文片段黑名單.php 3
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

checkARGV( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無頁碼, NL;
}
$黑名單 = 提取數據結構( 默認詩文檔碼_詩文重見名單 );

if( !array_key_exists( $默文檔碼, $黑名單 ) )
{
	echo "此文檔中任何詩文片段均可用作錨値。", NL;
}
else
{
	print_r( $黑名單[ $默文檔碼 ] );
}
?>