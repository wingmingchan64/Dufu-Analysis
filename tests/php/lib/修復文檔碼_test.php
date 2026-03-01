<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\修復文檔碼_test.php
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
確認相等( 修復文檔碼( '3' ), '0003', "case#: ${i}" );
$i++;
確認相等( 修復文檔碼( '13-1' ), '0013-1', "case#: ${i}" );
// 
$i++;
confirm_throw( function(){  修復文檔碼( '大' ); }, InvalidDocumentIDException::class, "case#: ${i}" ); 
// 不是數字
$i++;
確認會丟( function(){ 修復文檔碼( 'run-1' ); }, InvalidDocumentIDException::class, "case#: ${i}", '', $debug );
?>