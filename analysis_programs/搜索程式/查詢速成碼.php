<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\搜索程式\查詢速成碼.php 興慶宮
*/
//mb_internal_encoding( 'utf-8' );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

// 參數
check_argv( $argv, 2, 提供字詞 );
$字詞 = trim( $argv[ 1 ] );
$字數 = mb_strlen( $字詞 );
$pattern1 = "|速成碼: 首碼 \X+? 尾碼 \X+? 更新時間|";
$pattern2 = "|速成碼: 首碼 \X+? 更新時間|";
//$pattern = "|速成碼: 首碼 \X\(\w\) 尾碼 \X\(\w\)|";
//速成碼: 首碼 竹(h) 尾碼 金(c)
$matches = array();
$速成碼 = "";

foreach( range( 0, $字數 - 1 ) as $位置 )
{
	$字 = mb_substr( $字詞, $位置, 1 );
	$網址 = "https://www.xn--0vqu8au0tro7d.com/list/char/${字}";
	$str  = file_get_contents( $網址 );
	$有尾碼 = strpos( $str, "尾碼" );
	
	if( $有尾碼 !== false )
	{
		$pattern = $pattern1;
	}
	else
	{
		$pattern = $pattern2;
	}
	
	preg_match_all( $pattern, $str, $matches );
	$速成碼 .= mb_substr( $matches[ 0 ][ 0 ], 10, 1 );
	
	if( $有尾碼 !== false )
	{
		$速成碼 .= mb_substr( $matches[ 0 ][ 0 ], 18, 1 );
	} 
}

echo $速成碼, NL;
?>