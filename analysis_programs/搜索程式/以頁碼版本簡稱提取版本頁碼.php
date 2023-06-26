<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼版本簡稱提取版本頁碼.php 0013 今
=> 版本頁碼：張志烈主編《杜詩全集（今注本）》1.9,PDF75
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "書目簡稱.php" );


if( sizeof( $argv ) != 3 )
{
	echo "必須提供頁碼、書目簡稱。", "\n";
	exit;
}

$頁碼 = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );

if( !array_key_exists( '=' . $簡稱, $書目簡稱 ) )
{
	echo "找不著書本。\n";
	exit;
}
$書名 = $書目簡稱[ '=' . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . "${書名}頁碼索引" . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	$列陣名 = "頁碼_${簡稱}頁碼";
	echo 版本頁碼, '：', $書名, $$列陣名[ $頁碼 ], "\n";
}
else
{
	echo "沒有結果。\n";
}
?>