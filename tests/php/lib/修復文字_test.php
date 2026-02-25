<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\修復文字_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = true;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

// phase 1: local test
//echo 修復文字( '為', $debug );

// phase 2
$i = 1;
確認相等( 修復文字( '為' ), '爲', "case#: ${i}" );
$i++;
確認相等( 修復文字( '大' ), '大', "case#: ${i}" );
?>