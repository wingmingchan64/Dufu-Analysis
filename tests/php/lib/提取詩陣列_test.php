<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩陣列_test.php
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
確認爲眞( is_array( 提取詩陣列( '〚0013:1:〛' ) ), "case#: ${i}" );
$i++;
確認會丟( function(){ 提取詩陣列( '〚0013:〛' );  }, InvalidCoordinateException::class, "case#: ${i}", $debug );
?>