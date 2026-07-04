<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩首句→默詩碼.php 之子時相見
=>
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$result = array();
$temp = array();

$首句_默認詩碼 = 提取數據結構( 首句_默認詩碼 );

if( !array_key_exists( $詩文, $首句_默認詩碼 ) )
{
	echo "「${詩文}」不是任何杜詩的首句。", NL;
}
else
{
	echo "默詩碼：" . $首句_默認詩碼[ $詩文 ], NL;
}
?>