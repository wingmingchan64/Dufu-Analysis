<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取基準正文樹JSON_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
//echo mb_strlen( 提取基準正文樹JSON( '0013-1,5' ) );

$i = 1;
確認相等( mb_strlen( 提取基準正文樹JSON( '0013-1,5' ) ), 377, "case#: ${i}" );
$i++;
確認會丟( function(){ 提取基準正文樹JSON( '0013' );  }, InvalidPoemIDException::class, "case#: ${i}" );
?>