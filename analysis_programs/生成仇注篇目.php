<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成仇注篇目.php
*/
require_once( '常數.php' );
require_once( '函式.php' );

$contents = '';
$file = file_get_contents( 'H:\github\Dufu-Analysis\下定雅弘、松原 朗《杜甫全詩訳注》\訳目錄.txt' );
$lines = explode( NL, $file );
//print_r( $lines );

foreach( $lines as $line )
{
	if( $line == '' || strpos( $line, '//' ) === false )
	{
		continue;
	}
	$parts = explode( ' ', $line );
	$題 = trim( $parts[ 0 ] );
	$slashes = trim( $parts[ 1 ] );
	$頁 = trim( $parts[ 2 ] );
	$contents .= $題 . ' ' . $slashes . ' ' . $頁 . ' ' . NL;
}
file_put_contents( 'H:\github\Dufu-Analysis\下定雅弘、松原 朗《杜甫全詩訳注》\仇注篇目.txt', $contents );
?>