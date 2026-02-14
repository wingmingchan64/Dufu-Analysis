<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\後設標記轉換成陣列_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$陣列 = 後設標記轉換成陣列( '全', '0001', 9, '{"cat":"異","a":"沒"}','沒[一作波]' );
print_r( $陣列 );

/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>