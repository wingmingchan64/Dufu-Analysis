<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\提取書本資料.php 全 0003
php h:\github\Dufu-Analysis\analysis_programs\提取書本資料.php 仇 0042
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼_路徑.php' );

if( sizeof( $argv ) < 3 )
{
	echo "必須提供簡稱、頁碼。", "\n";
	exit;
}
$簡稱 = trim( $argv[ 1 ] );
echo $簡稱, "\n";
$頁碼 = trim( $argv[ 2 ] );
echo $頁碼_路徑[ $頁碼 ], "\n";

print_r( getSection( $頁碼_路徑[ $頁碼 ], '=' . $簡稱 ) );
?>