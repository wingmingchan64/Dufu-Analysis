<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取路徑字_test.php
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
$詩陣列 = 提取版本文檔( '全', '0098' );
確認相等( 提取路徑字( $詩陣列, array( '全0098', '1376', '1', '7', '1', '5' ) ), '死[一作且不死]' , "case#: ${i}" );
?>