<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩句提取注音.php 把釣待秋風
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\杜甫資料庫\\陳永明《杜甫全集粵音注音》\\詩句_注音.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩句。", "\n";
	exit;
}
$句 = trim( $argv[ 1 ] );
$result = array();

if( array_key_exists( $句, $詩句_注音 ) )
{
	$result = $詩句_注音[ $句 ];
}
else
{
	array_push( $result, "沒有結果。" );
}

print_r( $result );
?>