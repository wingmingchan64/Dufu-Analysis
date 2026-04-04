<?php
/*
php H:\github\Dufu-Analysis\tests\php\bin\pipeline\test_pipeline.php
 */
require_once( dirname( __FILE__, 5 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	'php' . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
 
require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .
	'functions.php' );

// part 1: hand-edit canonical text

// part 2: hand-edit edition text

// part 3: convert canonical text to a canonical text tree
$contents = file_get_contents( 
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR .
	'0003.txt' );
$tree = convert_text_to_tree( '0003', $contents );

file_put_contents(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '0003.json',
	json_encode(
		$tree, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

// part 4: convert edition text to a tree
$contents = file_get_contents( 
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR .
	'0003注文.txt' );
$atree = convert_annotation_to_tree( '2', $contents );

file_put_contents(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '0003注文.json',
	json_encode(
		$atree, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

// part 5: attach metadata to the tree
$metadata_txt = file_get_contents( 
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR .
	'0003後設資料.txt' );
process_metadata( $tree, $metadata_txt );

echo json_encode(
	$tree, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>