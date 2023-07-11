<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題用字→頁碼.php 奉先
=>
Array
(
    [遊龍門奉先寺] => 0042
    [奉先劉少府新畫山水障歌] => 0527
    [九日楊奉先會白水崔明府] => 0627
    [自京赴奉先縣詠懷五百字] => 0668
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );

checkARGV( $argv, 2, 提供詩題 );
$題 = trim( $argv[ 1 ] );
$result = array();

foreach( $詩題_頁碼 as $詩題 => $頁碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $詩題 ] = $頁碼;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>