<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼版本簡稱提取版本詩文校記.php 0276 全
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

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
$默認路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$詩題 = '';

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	$列陣名 = "${簡稱}内容";
	
	if( array_key_exists( 詩題, $$列陣名 ) )
	{
		$詩題 = $$列陣名[ 詩題 ];
	}
	else
	{
		require_once( $默認路徑 );
		$詩題 = $内容[ 詩題 ];
	}
	echo '《', $詩題, '》', NL, NL;
	$詩文 = $$列陣名[ 版本 ][ 詩文 ];
	echo format詩文( 移除詩文夾注( $詩文 ) ), NL;
	
	if( array_key_exists( 校記, $$列陣名 ) )
	{
		echo $$列陣名[ 校記 ] ;
	}
}
else
{
	echo 無結果 . NL;
}
?>