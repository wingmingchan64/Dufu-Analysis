<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\基準正文樹加句號_test.php
*/
//設定測試檔( basename( __FILE__ ) );
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
$store = array();
基準正文樹加句號( $樹, $store, true );

/*
$i = 1;
確認爲眞( 在詩文重見名單中( '3224', '青' ), "case#: ${i}" );
$i++;
確認爲眞( !在詩文重見名單中( '3224', '青山' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 在詩文重見名單中( '3224' ); }, 'ArgumentCountError', "case#: ${i}" );
$i++;
確認會丟( function(){ 在詩文重見名單中( '3223', '青山' ); }, InvalidDocumentIDException::class, 
	"case#: ${i}" );
*/
?>