<?php
/*
php H:\github\Dufu-Analysis\tests\php\bin\tree_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$文檔碼 = '2539';
$樹 = 提取數據結構( BASE_TEXT_DIR . $文檔碼 );
	
// 換字
替換路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${文檔碼}:3.2.1〛" ),
	'迴' );
// 刪字
替換路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${文檔碼}:3.2.1〛" ),
	空語鏈 );



print_r( json_encode( $樹, 
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
?>