<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取後設資料_test.php
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
確認爲眞( sizeof( 提取後設資料( '《全唐詩》' . DS . METADATA_DIR .
	'by_doc_id' .
	DS . '0002' ) ), 13, "case#: ${i}" );
$i++;
確認會丟( function(){ 提取後設資料( '〚0013:1:5〛' );  }, RuntimeException::class, "case#: ${i}" );
$i++;
確認會丟( function(){ 提取後設資料( '《全唐詩》' . DS . METADATA_DIR .
	'by_doc_id' .
	DS . '7000' );  }, RuntimeException::class, "case#: ${i}" );
?>