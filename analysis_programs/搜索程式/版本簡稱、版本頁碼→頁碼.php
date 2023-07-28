<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\版本簡稱、版本頁碼→頁碼.php 譯 2
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

checkARGV( $argv, 3, 提供簡稱、頁碼 );
$簡稱 = trim( $argv[ 1 ] );
$頁碼 = trim( $argv[ 2 ] );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . "蕭${簡稱}.txt";
$pattern = '|\[\d+]|';

if( file_exists( $路徑 ) )
{
	$text = explode( "\n", file_get_contents( $路徑 ) );
	foreach( $text as $line )
	{
		if( mb_strpos( $line, $書名 . $頁碼 . ',' ) !== false )
		{
			$matches = array();
			preg_match( $pattern, $line, $matches );
			echo trim( $matches[ 0 ], '[]' );
			break;
		}
	}
}
else
{
	echo 無結果 . NL;
}
?>