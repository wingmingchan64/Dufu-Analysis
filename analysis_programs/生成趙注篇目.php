<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成趙注篇目.php
*/
require_once( '函式.php' );

$contents = '';
$file = file_get_contents( 'H:\github\Dufu-Analysis\林繼中輯校《杜詩趙次公先後解輯校》\趙目錄.txt' );
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
	$contents .= $題 . ' ' . $slashes . ' ' . $頁 . ' ' . 
	'PDF' . NL;
}
file_put_contents( 'H:\github\Dufu-Analysis\林繼中輯校《杜詩趙次公先後解輯校》\趙注篇目.txt', $contents );
?>