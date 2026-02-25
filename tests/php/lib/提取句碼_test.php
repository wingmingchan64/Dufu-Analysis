<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取句碼_test.php
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
確認會丟( function(){ 提取句碼( '〚0013:1:5〛' );  }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認會丟( function(){ 確認相等( 提取句碼( '〚0013:1:5〛' ), '5' );  }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認相等( 提取句碼( '〚0013:1:5.2〛' ), '2', "case#: ${i}" );

?>