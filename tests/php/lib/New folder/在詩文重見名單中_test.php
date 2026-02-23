<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\在詩文重見名單中_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( 在詩文重見名單中( '3224', '青' ), 'case#: 1' );
確認爲眞( !在詩文重見名單中( '3224', '青山' ), 'case#: 2' );
確認會丟( function(){ 在詩文重見名單中( '3224' ); }, 'ArgumentCountError', 'case#: 3' );
確認會丟( function(){ 在詩文重見名單中( '3223', '青山' ); }, InvalidDocumentIDException::class, 
	'case#: 4' );
	
array_push( $test_results, "在詩文重見名單中_test: 4 cases tested." );
?>