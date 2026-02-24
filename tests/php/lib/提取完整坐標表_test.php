<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取完整坐標表_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
$i       = 0;
$passed  = 0;
$failed  = 0;
$skipped = 0;
$debug   = false;

確認同一( 提取完整坐標表( '3', $debug )[ 0 ], '〚0003:〛', $i++,"case#: {$i}" );

$test_results[ 
	str_replace( dirname( __DIR__, 1 ) .
	DIRECTORY_SEPARATOR, 
	'', $file ) . ": ${i} case(s) tested" ] = array(
		'Passed' => $passed,
		
	);
?>