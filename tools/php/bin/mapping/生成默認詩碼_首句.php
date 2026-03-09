<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩碼_首句.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$坐標_句 = 提取數據結構( 坐標_句 );
$默認詩碼_句坐標 = 提取數據結構( 默認詩碼_句坐標 );
$默認詩碼_首句 = array();
$首句_默認詩碼 = array();

foreach( $默認詩碼_句坐標 as $默認詩碼 => $句坐標s )
{
	$默認詩碼_首句[ $默認詩碼 ] =
		$坐標_句[ $句坐標s[ 0 ] ];
}
$首句_默認詩碼 = array_flip( $默認詩碼_首句 );

$json = json_encode(
	$默認詩碼_首句,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩碼_首句.json",
	$json . PHP_EOL );
	
$json = json_encode(
	$首句_默認詩碼,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"首句_默認詩碼.json",
	$json . PHP_EOL );
	
?>