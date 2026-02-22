<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\只有詩碼之完整坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( is_complete_coords_with_only_poem_id( '〚0003:〛' ), 'case#: 1' );
確認爲眞( is_complete_coords_with_only_poem_id( '〚0013:1:〛' ), 'case#: 2' );
確認會丟( function(){ 確認爲眞( 只有詩碼之完整坐標( '〚0013:〛' ) ); }, ConfirmationFailureException::class, 'case#: 3' );

array_push( $test_results, "只有詩碼之完整坐標_test: 3 cases tested." );
?>