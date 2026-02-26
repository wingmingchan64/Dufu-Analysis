<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\處理路徑文字_test.php
*/
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
	
$樹 = 提取詩碼基準正文樹( '0003' );
$路徑 = array( '0003', '5', '1', '5' );
處理路徑文字( $樹, $路徑, "快樂", false, $debug );
?>