<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\默文檔碼→詩題.php 0668
=> 詩題：自京赴奉先縣詠懷五百字
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"tools" . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"常數.php" );
require_once( PHP_GLOBAL_FUNCTIONS );

checkARGV( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fixPageNum( trim( $argv[ 1 ] ) );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無頁碼, NL;
}

if( array_key_exists( $默文檔碼, $默認詩文檔碼_詩題 ) )
{
	echo 詩題, '：', $默認詩文檔碼_詩題[ $默文檔碼 ], "\n";
}
else
{
	echo 無結果, NL;
}
?>