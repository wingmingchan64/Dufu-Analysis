<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字搜索版本頁碼.php 奉先 仇
=>
遊龍門奉先寺：仇兆鰲《杜詩詳註》1.1,PDF1.74,四庫0004
自京赴奉先縣詠懷五百字：仇兆鰲《杜詩詳註》1.264,PDF1.337,四庫4.20

php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字搜索版本頁碼.php 岑參 浦
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );
require_once( 書目簡稱 );

check_argv( $argv, 3, 提供題、簡 );
$題   = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );
$陣列命 = $簡稱 . "内容";
$書目 = $書目簡稱[ 等號 . $簡稱 ];
$詩題s = array();

foreach( $詩題_頁碼 as $詩題 => $頁碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$詩題s[ $詩題 ] = $頁碼;
	}
}

foreach( $詩題s as $詩題 => $頁碼 )
{
	$path = "h:\\杜甫資料庫\\${書目}\\${頁碼}.php";
	
	if( file_exists( $path ) )
	{
		require_once( $path );
		$首行 = $$陣列命[ 書名 ];
		echo $詩題 . 冒號 . $首行, NL;
	}
}
?>