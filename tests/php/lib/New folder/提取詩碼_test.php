<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩碼_test.php
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
確認相等( 提取詩碼( '〚0013:1:6.1.3〛' ), '0013-1', "case#: ${i}" );
$i++;
確認相等( 提取詩碼( '〚0003:5.1.3-4〛' ), '0003', "case#: ${i}" );
$i++;
確認會丟( function(){ 提取詩碼( '〚0012:1:5.1〛' );  }, InvalidCoordinateException::class, "case#: ${i}", 'Message here', true );
?>