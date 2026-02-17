<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索目錄\默認版本詩碼→各版本書頁碼.php 3
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默詩碼 );

$默詩碼 = 修復文檔碼( trim( $argv[ 1 ] ) );
$版本資料 = 提取目錄( "版本目錄對照表" );
$json = json_encode( 
	$版本資料[ $默詩碼 ],
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
$json = preg_replace( '/{/', '', $json );
$json = preg_replace( '/\s+}/', '', $json );
$json = str_replace( ',', '', $json );
$json = preg_replace( '/\[/', '', $json );
$json = preg_replace( '/\s+\]/', '', $json );

print_r( $json );
//print_r( $result );
?>