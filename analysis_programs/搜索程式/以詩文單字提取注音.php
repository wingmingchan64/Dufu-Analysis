<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文單字提取注音.php 上
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\杜甫資料庫\\陳永明《杜甫全集粵音注音》\\陳永明《杜甫全集粵音注音》字音.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩文單字。", "\n";
	exit;
}
$字 = trim( $argv[ 1 ] );
$result = array();

if( array_key_exists( $字, $字音 ) )
{
	$result = $字音[ $字 ];
}
else
{
	array_push( $result, "沒有結果。" );
}

print_r( $result );
?>