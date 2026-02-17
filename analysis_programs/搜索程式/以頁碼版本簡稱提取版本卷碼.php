<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼版本簡稱提取版本卷碼.php 0668 蕭
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

check_argv( $argv, 3, 提供頁、簡 );
$頁碼 = trim( $argv[ 1 ] );
$頁碼數目 = intval( $頁碼 );
$簡稱 = trim( $argv[ 2 ] );
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . $簡稱 . "頁碼、卷碼" . 程式後綴;

require_once( $路徑 );

$陣列名 = "${簡稱}頁碼、卷碼";

foreach( $$陣列名 as $頁範圍 => $卷碼 )
{
	$起止 = explode( '-', $頁範圍 );
	$起止範圍 = range( intval( $起止[ 0 ] ), intval( $起止[ 1 ] ) );
	
	if( in_array( $頁碼數目,  $起止範圍  ) )
	{
		echo $卷碼, NL;
		exit; // return
	}
}
echo 無結果;
?>