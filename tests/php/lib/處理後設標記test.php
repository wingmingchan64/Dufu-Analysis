<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\處理後設標記_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );


確認爲眞( 處理後設標記( '郭', '0001', '', true, true ), 'case#: 1' );

array_push( $test_results, "處理後設標記_test: 1 case tested." );
?>