<?php
/**
php H:\github\Dufu-Analysis\docs\workflow\demo_php_program\combine_subtrees.php
*/

// part 1: create new tree
$root_name = '0001';
$tree[ $root_name ] = array();

// part 2: attach subtrees
// 1376-3
// 1395-2
$base_text_dir = dirname( __dir__, 3 ) .
	DIRECTORY_SEPARATOR .
	'schemas' . DIRECTORY_SEPARATOR .
	'json' . DIRECTORY_SEPARATOR .
	'base_text' . DIRECTORY_SEPARATOR;
$子樹1 = json_decode( file_get_contents(
	$base_text_dir . '1376-3.json' ), true );

$tree[ $root_name ][ '1' ] = $子樹1[ '1376' ][ '3' ];

$子樹2 = json_decode( file_get_contents(
	$base_text_dir . '1395-2.json' ), true );

$tree[ $root_name ][ '2' ] = $子樹2[ '1395' ][ '2' ];

print_r( $tree );
?>