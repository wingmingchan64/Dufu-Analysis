<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\含首碼_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( 含首碼( '〚0013:1:5.1.2〛' ), 'case#: 1' );
確認會丟( function(){ 
	確認爲眞( contain_member_poem_id( '〚0003:5.1.2〛' ) );
	}, 
	ConfirmationFailureException::class, 'case#: 2' );

array_push( $test_results, "含首碼_test: 2 cases tested." );
?>