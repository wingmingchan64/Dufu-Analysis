<?php
/*
// 兩字同時出現在同一個詩題內。
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題雙字→頁碼.php 夜 懷
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );

checkARGV( $argv, 3, 提供雙字 );
$首字 = trim( $argv[ 1 ] );
$次字 = trim( $argv[ 2 ] );
$result = array();

foreach( $詩題_頁碼 as $題 => $頁 )
{	
	if( mb_strpos( $題, $首字 ) !== false &&
		mb_strpos( $題, $次字 ) !== false )
	{
		array_push( $result, $頁 . ' ' . $題 );
	}
}
print_r( $result );
?>