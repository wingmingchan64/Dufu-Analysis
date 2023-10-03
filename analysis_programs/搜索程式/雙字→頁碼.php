<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\雙字→頁碼.php 愁 酒
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );

checkARGV( $argv, 3, 提供頁碼 );
$首字 = trim( $argv[ 1 ] );
$次字 = trim( $argv[ 2 ] );
$result = array();

foreach( $頁碼 as $頁 )
{
	require_once( 詩集文件夾 . $頁 . 程式後綴 );
	
	if( mb_strpos( $内容[ 詩文 ], $首字 ) !== false &&
		mb_strpos( $内容[ 詩文 ], $次字 ) !== false )
	{
		array_push( $result, $頁 );
	}
}
print_r( $result );
?>