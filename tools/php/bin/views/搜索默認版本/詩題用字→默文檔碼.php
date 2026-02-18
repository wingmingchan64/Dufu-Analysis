<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題用字→默文檔碼.php 奉先
=>
Array
(
    [遊龍門奉先寺] => 0042
    [奉先劉少府新畫山水障歌] => 0527
    [九日楊奉先會白水崔明府] => 0627
    [自京赴奉先縣詠懷五百字] => 0668
)
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩題 );
$題 = fix_text( trim( $argv[ 1 ] ) );

$詩題_默認詩文檔碼 = 提取數據結構( 詩題_默認詩文檔碼 );

$result = array();

foreach( $詩題_默認詩文檔碼 as $詩題 => $默文檔碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $詩題 ] = $默文檔碼;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>