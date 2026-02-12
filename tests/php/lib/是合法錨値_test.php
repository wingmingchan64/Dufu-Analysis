<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是合法錨値_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( 是合法錨値( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法錨値( '為' ), 'case#: 2' );
確認爲眞( !是合法錨値( '軌道' ), 'case#: 3' );
確認爲眞( 是合法錨値( '〚0013:〛' ), 'case#: 4' );
確認爲眞( !是合法錨値( '〚0014:1〛' ), 'case#: 5' );
確認爲眞( 是合法錨値( '〚1〛' ), 'case#: 6' );
確認爲眞( 是合法錨値( '〚1:〛' ), 'case#: 7' );
確認爲眞( !是合法錨値( '〚21:〛' ), 'case#: 8' );

array_push( $test_results, "是合法錨値_test: 8 cases tested." );

?>