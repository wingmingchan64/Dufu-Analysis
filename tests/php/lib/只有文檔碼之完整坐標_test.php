<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\只有文檔碼之完整坐標_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認爲眞( is_complete_coords_with_only_doc_id( '〚0003:〛' ), "case#: ${i}" );
$i++;
確認爲眞( is_complete_coords_with_only_doc_id( '〚0013:〛' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 只有文檔碼之完整坐標( '〚0002:〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
?>