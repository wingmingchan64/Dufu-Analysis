<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\默認版本定位\默文檔碼→詩題.php 0668
=> 詩題：自京赴奉先縣詠懷五百字
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo "默文檔碼「${默文檔碼}」不存在。", NL;
	return;
}

if( array_key_exists( $默文檔碼, $默認詩文檔碼_詩題 ) )
{
	echo 詩題, '：', $默認詩文檔碼_詩題[ $默文檔碼 ], "\n";
}
?>