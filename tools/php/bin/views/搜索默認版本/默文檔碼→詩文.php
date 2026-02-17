<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默文檔碼→詩文.php 3
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
	echo 無頁碼, NL;
}
$詩文文檔路徑 = 默認版本詩文件夾 . $默文檔碼 . '.txt';
echo NL, file_get_contents( $詩文文檔路徑 );
?>