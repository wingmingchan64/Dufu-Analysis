<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\只有詩碼之完整坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( is_coords_with_only_poem( '〚0003:〛' ), 'case#: 1' );
確認爲眞( is_coords_with_only_poem( '〚0013:〛' ), 'case#: 1' );


/*

確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>