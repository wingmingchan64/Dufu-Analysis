<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\版本簡稱、版本頁碼→頁碼.php 今 2
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
$路徑 = 杜甫資料庫 . "${書名}\\${書名}頁碼索引.php";
require_once( $路徑 );
//$pattern = '|\[\d+]|';
$陣列名 = "頁碼_${簡稱}頁碼";

foreach( $$陣列名 as $頁 => $版頁 )
{
	$parts = explode( ',', $版頁 );
	$版頁 = $parts[ 0 ];
	
	if( strpos( $版頁, '.' ) !== false )
	{
		//echo , NL;
		$版頁 = explode( '.', $版頁 )[ 1 ];
	}
	else
	{
		
	}
	
	if( $版頁 == $頁碼 )
	{
		echo $頁, NL;
		exit;
	}
}
echo 無結果 . NL;
?>