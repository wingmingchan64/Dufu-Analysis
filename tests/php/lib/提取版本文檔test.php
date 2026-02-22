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

$詩陣列 = 提取版本文檔( '全', '0098' );
$詩陣列 = 提取版本文檔( '全', '0002' );
//print_r( $詩陣列 );
//print_r( 提取詩陣列詩文( $詩陣列, true, true ) );

//echo implode( NL.NL, 提取詩陣列詩文( $詩陣列, true, true ) );



/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>