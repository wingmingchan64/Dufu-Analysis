<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0003:〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5-6〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0003:3.1〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5.1〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5.1.2〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5.1.2-3〛
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供完整坐標 );
$坐標 = trim( $argv[ 1 ] );

if( 是合法完整坐標( $坐標 ) )
{
/*
	$首碼 = '';
	//$陣列
	// 完整坐標轉換成路徑列陣
	
	// 是含範圍字碼完整坐標
	// 提取擴充範圍字碼坐標
	// 提取擴充範圍行碼坐標
	//print_r( $詩陣列 );
	//顯示坐標値( $詩陣列, $坐標 );
*/	
	$result = 提取坐標文字內容( $坐標 );
	echo $result, NL;
	
}
else
{
	echo 無結果, NL;
}
?>