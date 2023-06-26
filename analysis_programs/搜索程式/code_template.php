<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼搜索詩題.php 0668
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "頁碼_詩題.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供頁碼。", "\n";
	exit;
}

?>