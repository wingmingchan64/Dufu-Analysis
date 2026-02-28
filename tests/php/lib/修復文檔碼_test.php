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
// 0004 與 0003 不同
$i++;
confirm_throw( function(){ confirm_identical( 修復文檔碼( '4' ), '0003' ); }, ConfirmationFailureException::class, "case#: ${i}", '', true );
// 不是數字
$i++;
確認會丟( function(){ 修復文檔碼( 'run-1' ); }, InvalidDocumentIDException::class, "case#: ${i}" );
?>