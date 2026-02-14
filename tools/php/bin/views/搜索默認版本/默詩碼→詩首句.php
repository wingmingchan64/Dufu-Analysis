<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默詩碼→詩首句.php 0668
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

checkARGV( $argv, 2, 提供默詩碼 );
$默詩碼 = 修復文檔碼( trim( $argv[ 1 ] ) );

$默認詩碼_首句 = 提取數據結構( 默認詩碼_首句 );

if( !array_key_exists( $默詩碼, $默認詩碼_首句 ) )
{
	echo 無詩碼, NL;
}
else
{
	echo $默認詩碼_首句[ $默詩碼 ], NL;
}
?>