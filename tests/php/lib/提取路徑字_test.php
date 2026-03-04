<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取路徑字_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidPathException;

設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
確認相等( 提取路徑字( $樹, 
	array( '0003', '3', '1', '5' ) ), 
	'何' , "case#: ${i}" );
$i++;
$路徑 = array( '0003', '3', '1', '5' );
確認會丟( function(){ 
	提取路徑字( 
		提取數據結構( BASE_TEXT_DIR . '0003' ),
		array( '0002', '3', '1', '5' ) ); }, InvalidPathException::class, "case#: ${i}" );
$i++;
?>