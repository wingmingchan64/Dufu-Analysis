<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字注音搜索版本頁碼.php "fong4 bing1 cou4" 仇
=>
房兵曹胡馬：仇兆鰲《杜詩詳註》1.18,PDF1.91,四庫0019

php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字注音搜索版本頁碼.php "sam4 sam1" 浦
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );
require_once( 書目簡稱 );
require_once( 詩題_注音 );

check_argv( $argv, 3, 提供題音、簡 );
$題音 = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );
$陣列命 = $簡稱 . "内容";
$書目 = $書目簡稱[ 等號 . $簡稱 ];
$詩題s = array();
$注音_詩題 = array_flip( $詩題_注音 );
$result = array();

foreach( $注音_詩題 as $音 => $題 )
{
	if( strpos( $音, $題音 ) !== false )
	{
		$result[ $題 ] = $詩題_頁碼[ $題 ];
	}
}

foreach( $result as $詩題 => $頁碼 )
{
	$path = "h:\\杜甫資料庫\\$書目\\${頁碼}.php";
	
	if( file_exists( $path ) )
	{
		require_once( $path );
		$首行 = $$陣列命[ 書名 ];
		echo $詩題 . 冒號 . $首行, NL;
	}
}
?>