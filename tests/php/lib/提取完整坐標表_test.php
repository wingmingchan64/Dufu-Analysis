<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取完整坐標表_test.php
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
確認相等( 提取完整坐標表( '3', $debug )[ 0 ], '〚0003:〛',"case#: {$i}" );
$i++;
確認相等( sizeof( 提取完整坐標表( '3', $debug ) ), 140,"case#: {$i}" );
?>