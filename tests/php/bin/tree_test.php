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

$詩碼 = '2539';
$樹 = 提取基準正文樹( $詩碼 );
	
// 換字
替換路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${詩碼}:3.2.1〛" ),
	'迴' );
// 刪字
替換路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${詩碼}:3.2.1〛" ),
	空語鏈 );
// 插入夾注
插入路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${詩碼}:3.2.4〛" ),
	'[子盈切]' ); // 旌[子盈切]
// 插入數字
插入路徑字( $樹, 
	完整坐標轉換成路徑列陣( "〚${詩碼}:3.2.4〛" ),
	'[1]' ); // 旌[1]
// 兩句呼喚位置： 高樓鼓角悲，風起春城暮
$temp = $樹[ $詩碼 ][ '4' ][ '1' ];
$樹[ $詩碼 ][ '4' ][ '1' ] = $樹[ $詩碼 ][ '4' ][ '2' ];
$樹[ $詩碼 ][ '4' ][ '2' ] = $temp;

unset( $樹[ $詩碼 ][ '3' ] );

print_r( json_encode( $樹, 
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
	
//echo implode( NL, 提取詩陣列詩文( $樹 ) );
?>