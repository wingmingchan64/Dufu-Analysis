<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取擴充範圍字碼坐標_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認相等( 提取擴充範圍字碼坐標( '〚0013:1:5.2.4-5〛' ),
	array( '〚0013:1:5.2.4〛', '〚0013:1:5.2.5〛' ), "case#: {$i}" );
$i++;
確認爲眞( sizeof( 提取擴充範圍字碼坐標( '〚0013:1:5.2.1-4〛' ) ), 4, "case#: {$i}" );
$i++;
確認會丟( function(){ 提取擴充範圍字碼坐標( '〚1:5.2.1-4〛' );  }, IncompleteCoordinateException::class, "case#: ${i}" );
?>