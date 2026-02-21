<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取首碼_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

//echo 提取首碼( '〚0013:〛' );
提取首碼( '〚0013:2:〛' );
exit;

確認會丟( function(){ 提取首碼( '〚0013:〛' ); }, InvalidCoordinateException::class, 'case#: 1' );
確認同一( 提取首碼( '〚0013:2:〛' ), '2', 'case#: 2' );
確認會丟( function(){ 
	確認同一( 提取首碼( '〚0013:12:〛' ), '13', '' );
	}, 
	ConfirmationFailureException::class, 'case#: 3' );

array_push( $test_results, "提取首碼_test: 3 cases tested." );

?>