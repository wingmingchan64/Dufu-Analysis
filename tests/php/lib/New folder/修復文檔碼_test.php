<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\修復文檔碼_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認同一( 修復文檔碼( '3' ), '0003', 'case#: 1' );
確認同一( 修復文檔碼( '13-1' ), '0013-1', 'case#: 2' );
// 0004 與 0003 不同
確認會丟( function(){ 確認同一( 修復文檔碼( '4' ), '0003' ); }, ConfirmationFailureException::class, 'case#: 3' );
// 不是數字
確認會丟( function(){ 修復文檔碼( 'run-1' ); }, InvalidDocumentIDException::class, 'case#: 4' );
// english function call
confirm_identical( fix_doc_id( '3' ), '0003', 'case#: 5' );

array_push( $test_results, "修復文檔碼_test: 5 cases tested." );

?>