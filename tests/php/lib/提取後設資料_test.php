<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取後設資料_test.php
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
//確認爲眞( 
print_r( 提取後設資料( '《全唐詩》' . DS . METADATA_DIR .
	'by_doc_id' .
	DS . '0002' ) );
	
	//, "case#: ${i}" );
$i++;
/*
確認會丟( function(){ 提取後設資料( '〚0013:1:5〛' );  }, InvalidCoordinateException::class, "case#: ${i}" );
*/
?>