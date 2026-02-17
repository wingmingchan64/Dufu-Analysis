<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字搜索詩題.php 岳
=> Array
(
    [望岳] => Array
        (
            [0] => 1144
            [1] => 5792
        )

    [寄岳州賈司馬六丈、巴州嚴八使君兩閣老五十韻] => 1642
    [泊岳陽城下] => 5667
    [登岳陽樓] => 5673
    [陪裴使君登岳陽樓] => 5680
    [過南岳入洞庭湖] => 5689
    [岳麓山道林二寺行] => 5732
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );

check_argv( $argv, 2, 提供詩題 );
$題 = trim( $argv[ 1 ] );
$result = array();
$詩題s = array_keys( $詩題_頁碼 );

foreach( $詩題s as $詩題 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $詩題 ] = $詩題_頁碼[ $詩題 ];
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( 無結果 );
}
print_r( $result );
?>