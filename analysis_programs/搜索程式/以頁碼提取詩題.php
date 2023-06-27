<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼提取詩題.php 0668
=> 詩題：自京赴奉先縣詠懷五百字
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼_詩題 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );

if( array_key_exists( $頁碼, $頁碼_詩題 ) )
{
	echo 詩題, '：', $頁碼_詩題[ $頁碼 ], "\n";
}
else
{
	echo 無結果, NL;
}
?>