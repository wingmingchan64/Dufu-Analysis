<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\列陣路徑轉換成完整坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

echo 列陣路徑轉換成完整坐標( array( '0013', '1', '5' ) ), NL;



/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>