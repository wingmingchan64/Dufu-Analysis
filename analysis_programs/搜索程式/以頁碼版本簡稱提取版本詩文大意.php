<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼版本簡稱提取版本詩文大意.php 0668 仇
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
//require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\搜索程式\\以坐標提取詩文.php" );

check_argv( $argv, 3, 提供頁、簡 );
$頁碼 = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	$列陣名 = "${簡稱}内容";
	foreach( $$列陣名[ 大意 ] as $坐標 => $段落大意 )
	{
		echo 以坐標提取詩文( trim( $坐標, '〚〛' ) )[ 詩文 ], NL;
		echo $段落大意, NL, NL;
	}
}
else
{
	echo 無結果 . NL;
}
?>