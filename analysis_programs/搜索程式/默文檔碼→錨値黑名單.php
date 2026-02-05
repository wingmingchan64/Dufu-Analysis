<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\默文檔碼→錨値黑名單.php 0003
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

checkARGV( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fixPageNum( trim( $argv[ 1 ] ) );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$重見名單 = 提取數據結構( 默認詩文檔碼_詩文重見名單 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無頁碼, NL;
}
if( array_key_exists( $默文檔碼, $重見名單 ) )
{
	print_r( $重見名單[ $默文檔碼 ] );
}
else
{
	echo "此文檔無黑名單。", NL;
}
?>