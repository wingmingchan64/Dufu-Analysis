<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取字碼_test.php
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
確認相等( 提取字碼( '〚0013:1:6.1.3〛' ), '3', "case#: ${i}" );
$i++;
確認相等( 提取字碼( '〚0013:1:7.1.3-4〛' ), '3-4', "case#: ${i}" );
$i++;
確認會丟( function(){ 提取字碼( '〚0013:1:5.1〛' );  }, InvalidCoordinateException::class, "case#: ${i}" );
?>