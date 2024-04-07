<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→資料匯總.php 0013
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
// wrong page number
if( !array_key_exists( $頁碼, $頁碼_詩題 ) )
{
	echo 無頁碼, NL;
}
echo file_get_contents( 資料匯總文件夾 . $頁碼 . '.txt' );
?> 