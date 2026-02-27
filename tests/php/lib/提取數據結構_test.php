<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取數據結構_test.php
*/
//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認相等( sizeof( 提取數據結構( 完整坐標表文件夾 . '0003' ) ), 140, "case#: ${i}" );
$i++;
確認會丟( function(){ 提取數據結構( 完整坐標表文件夾 . '0002' );  }, RuntimeException::class, "case#: ${i}" );
?>