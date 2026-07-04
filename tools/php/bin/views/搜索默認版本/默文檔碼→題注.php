<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默文檔碼→題注.php 0214
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
	echo "默文檔碼「${默文檔碼}」不存在。", NL;
	return;
}

$默認詩文檔碼_題注 = 提取數據結構( 默認詩文檔碼_題注 );

if( array_key_exists( $默文檔碼, $默認詩文檔碼_題注 ) )
{
	print_r( $默認詩文檔碼_題注[ $默文檔碼 ] );
}
else
{
	echo "默文檔碼「${默文檔碼}」沒有題注。", NL;
}
?>