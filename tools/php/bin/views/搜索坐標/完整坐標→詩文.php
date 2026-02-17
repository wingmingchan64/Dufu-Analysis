<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:〛
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0003:〛
H:\github\Dufu-Analysis\tools\php\bin\views\搜索坐標\完整坐標→詩文.php 〚0013:1:5.1.2〛
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供完整坐標 );
$坐標 = trim( $argv[ 1 ] );

if( 是合法完整坐標( $坐標 ) )
{
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	$詩碼 = 提取詩碼( $坐標 );
	$詩陣列 = 提取數據結構( BASE_TEXT_DIR . $詩碼 );
	$首碼 = '';
	//$陣列
	// 完整坐標轉換成列陣路徑
	
	// 是含範圍字碼完整坐標
	// 提取擴充範圍字碼坐標
	// 提取擴充範圍行碼坐標
	//print_r( $詩陣列 );
	//顯示坐標値( $詩陣列, $坐標 );
	
	if( 是組詩( $文檔碼 ) )
	{
		$首碼 = 提取首碼( $坐標 );
		echo 杜甫詩陣列首ToString( $詩陣列[ $文檔碼 ][ $首碼 ] );
	}
	else
	{
		顯示坐標値( $詩陣列, $坐標 );
		//echo 杜甫詩陣列首ToString( $詩陣列[ $文檔碼 ] );
	}
}
else
{
	echo 無結果, NL;
}
?>