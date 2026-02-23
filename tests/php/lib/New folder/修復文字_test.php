<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\修復文字_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認同一( 修復文字( '為' ), '爲', 'case#: 1' );
確認同一( 修復文字( '大' ), '大', 'case#: 2' );

array_push( $test_results, "修復文字_test: 2 cases tested." );
?>