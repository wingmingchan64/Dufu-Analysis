<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\顯示數據結構.php 帶序言之詩
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供結構名稱 );
$結構名 = 修復文字( trim( $argv[ 1 ] ) );

$數據結構名稱 = array(
	'默認詩文檔碼_詩題' => 默認詩文檔碼_詩題,
	'默認詩文檔碼_題注' => 默認詩文檔碼_題注,
	'默認詩文檔碼_序言' => 默認詩文檔碼_序言,
	'默認詩碼_首句'    => 默認詩碼_首句,
	'帶序言之詩'       => 帶序言之詩,
);

$結構 = 提取數據結構( $數據結構名稱[ $結構名 ] );
print_r( $結構 );

?>