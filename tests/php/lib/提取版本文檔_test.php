<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取版本文檔_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$result = 提取版本文檔( '全', '0098' );
//$result = 提取版本文檔( '全', '0002' );
$store = array();
//print_r( $result );
$store = array();

//foreach( $result as $詩 )
//{
	//echo 杜甫詩陣列首ToString( $詩 );
提取詩陣列詩文( $result, $store );
//print_r( $result );
//print_r( $store );
echo implode( NL.NL, $store );
//echo implode( NL, $store );
//}

//$陣列 = 提取數據結構( BASE_TEXT_DIR . '0003' );
//print_r( $陣列 );
//$路徑 = [ '0003', '3', '1', '2' ];

//echo $陣列[ $路徑[ 0 ] ][ $路徑[ 1 ] ][ $路徑[ 2 ] ][ $路徑[ 3 ] ];
//插入路徑字( $陣列, $路徑, 0, 'da' );
//print_r( $陣列 );




/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>