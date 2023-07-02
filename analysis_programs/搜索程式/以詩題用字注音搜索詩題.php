<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字注音搜索詩題.php "fung6 sin1"
=> Array
(
    [jau4 lung4 mun4 fung6 sin1 zi6] => 0042 遊龍門奉先寺
    [fung6 sin1 lau4 siu3 fu2 san1 waak6 saan1 seoi2 zoeng3 go1] => 0527 奉先劉少府新畫山水障歌
    [zi6 ging1 fu6 fung6 sin1 jyun6 wing6 waai4 ng5 baak3 zi6] => 0668 自京赴奉先縣詠懷五百字
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_注音 );
require_once( 詩題_頁碼 );

checkARGV( $argv, 2, 提供題音 );
$音 = trim( $argv[ 1 ] );
$result = array();
$注音_詩題 = array_flip( $詩題_注音 );

foreach( $注音_詩題 as $注音 => $詩題 )
{
	if( containsPronunciation( $注音, $音 ) )
	{
		$result[ $注音 ] = $詩題_頁碼[ $詩題 ] . ' ' . $詩題;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( 無結果 );
}
print_r( $result );
?>