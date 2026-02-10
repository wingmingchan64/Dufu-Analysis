<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成組詩_副題.php

135 組詩
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
require_once( __DIR__ . DS . '詩組_詩題.php' );

$組詩_副題 = array();
$pages = array_keys( $詩組_詩題 );

foreach( $pages as $p )
{
	$組詩_副題[ $p ] = array();
	$組詩_副題[ $p ][ 詩題 ] = $詩組_詩題[ $p ][ 0 ];
	
	$contents = file_get_contents( "H:\\github\\DuFu\\默認版本\\詩\\${p}.txt" );
	$lines = explode( NL, $contents );
	
	$size = sizeof( $詩組_詩題[ $p ][ 1 ] );
	
	for( $i=1;$i<=$size;$i++ )
	{
		$組詩_副題[ $p ][ $i ] = array();
		$行碼 = $詩組_詩題[ $p ][ 1 ][ $i - 1 ];
		$副題 = $lines[ $行碼 - 1 ];
		$組詩_副題[ $p ][ $i ][ $行碼 ] = $副題;
	}
}
//print_r( $組詩_副題 );

// 組詩.json
$json = json_encode(
    $組詩_副題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
file_put_contents(
	'H:\github\Dufu-Analysis\schemas\json\mapping\組詩_副題.json',
	$json . PHP_EOL );

/*
// 組詩.json
$json = json_encode(
    $temp,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
file_put_contents(
	'H:\github\Dufu-Analysis\schemas\json\ids\組詩.json',
	$json . PHP_EOL );
*/
?>