<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取坐標文字內容_test.php
*/
//設定測試檔( basename( __FILE__ ) );
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認相等( 提取坐標文字內容( '〚0013:1:5〛' ), "春山無伴獨相求，伐木丁丁山更幽。", "case#: ${i}" );
$i++;
確認相等( 提取坐標文字內容( '〚0013:1:5.1.2-4〛' ), "山無伴", "case#: ${i}" );
$i++;
確認相等( 
	mb_strlen( 提取坐標文字內容( '〚0013:1:〛' ) ), 64, "case#: ${i}" );
$i++;
// 〚0013:1:3〛指向副題
確認會丟( function(){ 提取坐標文字內容( '〚0013:1:3〛' );  }, ErrorException::class, "case#: ${i}" );
$i++;
//確認會丟( function(){ 確認相等( 提取坐標文字內容( '〚0013:1:5〛' ), '' );  }, InvalidCoordinateException::class, "case#: ${i}" );

?>