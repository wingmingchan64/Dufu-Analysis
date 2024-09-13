<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩句→注音.php 把釣待秋風
=> baa2 diu3 doi6 cau1 fung1
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩句_注音 );

checkARGV( $argv, 2, 提供詩句 );
$句 = fixText( trim( $argv[ 1 ] ) );
$result = array();

if( array_key_exists( $句, $詩句_注音 ) )
{
	$result = $詩句_注音[ $句 ];
}
else
{
	array_push( $result, 無結果 );
}

print_r( $result );
?>