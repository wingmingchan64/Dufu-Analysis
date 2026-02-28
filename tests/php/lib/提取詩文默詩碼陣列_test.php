<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩文默詩碼陣列_test.php
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
確認相等( 提取詩文默詩碼陣列( array( '乾坤', '醉', '大' ) ), 
	array( '1642' ), "case#: ${i}" );
$i++;
確認相等( 提取詩文默詩碼陣列( array( '之子', '時', '相見' ) ), 
	array( '0013-2' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 提取詩文默詩碼陣列( array( '之子', '時間', '相見' ) );  }, InvalidPoemFragmentException::class, "case#: ${i}" );
?>