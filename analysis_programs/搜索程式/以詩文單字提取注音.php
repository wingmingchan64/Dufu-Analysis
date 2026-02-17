<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文單字提取注音.php 上
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫全集粵音注音文件夾 . '陳永明《杜甫全集粵音注音》字音.php' );
require_once( 杜甫資料庫 . '修正統一碼字_粵音.php' );

check_argv( $argv, 2, 提供單字 );
$字 = trim( $argv[ 1 ] );
$result = array();

if( array_key_exists( $字, $字音 ) )
{
	$result = $字音[ $字 ];
}
elseif( array_key_exists( $字, $修正統一碼字_粵音 ) )
{
	$result = $修正統一碼字_粵音[ $字 ];
}
else
{
	array_push( $result, 無結果 );
}

print_r( $result );
?>