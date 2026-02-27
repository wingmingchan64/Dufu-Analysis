<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取文檔碼_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

// 不管坐標是否合法
$i = 1;
確認相等( 提取文檔碼( '〚0013:12:〛' ), '0013', "case#: {$i}" );
$i++;
確認相等( 提取文檔碼( '〚0003:5.1〛' ), '0003', "case#: {$i}" );
$i++;
確認會丟( function(){ 提取首碼( '〚13:〛' ); }, InvalidCoordinateException::class, "case#: {$i}" );
?>