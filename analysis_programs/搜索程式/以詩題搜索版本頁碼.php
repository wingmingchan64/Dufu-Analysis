<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題搜索版本頁碼.php 房兵曹 仇

php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題搜索版本頁碼.php 岑參 浦
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\杜甫資料庫\\詩題_頁碼.php" );
require_once( "h:\\杜甫資料庫\\書目簡稱.php" );

if( sizeof( $argv ) != 3 )
{
	echo sizeof( $argv ), "\n";
	echo "必須提供詩題、版本簡稱。", "\n";
	exit;
}
$題   = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );
$陣列命 = $簡稱 . "内容";
$書目 = $書目簡稱[ '=' . $簡稱 ];
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
	$path = "h:\\杜甫資料庫\\$書目\\${頁碼}.php";
	
	if( file_exists( $path ) )
	{
		require_once( $path );
		$首行 = $$陣列命[ 書名 ];
		echo $首行, "\n";
	}
}
?>