<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取字碼_test.php
*/
ini_set( 'memory_limit', '5196M' );

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );


確認會丟( function(){ 提取字碼( '〚0013:1:5.1〛' );  }, InvalidCoordinateException::class, 'case#: 1' );
確認同一( 提取字碼( '〚0013:1:6.1.3〛' ), '3', 'case#: 2' );
確認同一( 提取字碼( '〚0013:1:7.1.3-4〛' ), '3-4', 'case#: 3' );

array_push( $test_results, "提取字碼_test: 3 cases tested." );
?>