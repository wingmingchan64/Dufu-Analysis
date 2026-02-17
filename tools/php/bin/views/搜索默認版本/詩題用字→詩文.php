<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩題用字→詩文.php 
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩題 );
$題 = fixText( trim( $argv[ 1 ] ) );
$詩題_默認詩文檔碼 = 提取數據結構( 詩題_默認詩文檔碼 );
$result = array();


foreach( $詩題_默認詩文檔碼 as $詩題 => $默文檔碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$詩文文檔路徑 = 默認版本詩文件夾 . $默文檔碼 . '.txt';
		$result[ $詩題 ] = file_get_contents( $詩文文檔路徑 );
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>