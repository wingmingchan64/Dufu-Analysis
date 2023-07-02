<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\版本異體字轉換.php 郭

*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

checkARGV( $argv, 2, 提供簡稱 );
$簡稱 = trim( $argv[ 1 ] );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
require_once( 杜甫資料庫 . $書名 . "\\" . '異體字轉換表.php' );
$in_file = file_get_contents( 杜甫資料庫 . $書名 . "\\" . 'in.txt' );
foreach( $異體字轉換表 as $s => $t )
{
	$in_file = str_replace( $s, $t, $in_file );
}
file_put_contents( 杜甫資料庫 . $書名 . "\\" . 'out.txt', $in_file );
?> 