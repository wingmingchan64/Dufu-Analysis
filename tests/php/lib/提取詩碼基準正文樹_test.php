<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩碼基準正文樹_test.php
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
確認爲眞( is_array( 提取詩碼基準正文樹( '0013-1' ) ), "case#: ${i}" );
$i++;
確認會丟( function(){ 提取基準正文樹JSON( '0013' );  }, InvalidPoemIDException::class, "case#: ${i}", $debug );

?>