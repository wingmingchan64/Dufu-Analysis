<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成完整坐標_路徑陣列.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼_完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

$path = dirname( __DIR__, 4 ) . SCHEMAS_JSON_COORDS_DIR.
	'coords_path' . DS;
	
$文檔 = '0003';
$chart = $默認詩文檔碼_完整坐標表[ $文檔 ];
$store = array();
$store[ $文檔 ] = array();

foreach( $chart as $坐標 )
{
	if( mb_strpos( $坐標, '-' ) === false )
	{
		$store[ $文檔 ][ $坐標 ] = 完整坐標轉換成路徑列陣( $坐標 );
	}
}
print_r( $store );
?>