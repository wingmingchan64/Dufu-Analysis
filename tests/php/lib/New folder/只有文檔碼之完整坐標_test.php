<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\只有文檔碼之完整坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( is_complete_coords_with_only_doc_id( '〚0003:〛' ), 'case#: 1' );
確認爲眞( is_complete_coords_with_only_doc_id( '〚0013:〛' ), 'case#: 2' );
確認會丟( function(){ 只有文檔碼之完整坐標( '〚0002:〛' ); }, InvalidCoordinateException::class, 'case#: 3' );

array_push( $test_results, "只有文檔碼之完整坐標_test: 3 cases tested." );
?>