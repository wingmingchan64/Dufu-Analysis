<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是合法完整坐標_test.php
*/
//設定測試檔( basename( __FILE__ ) );
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
	
echo 是合法完整坐標( '〚0013:1:4〛', $debug );

//確認爲眞( 是合法完整坐標( '〚6093:31-33〛' ), 'case#: 1' );

/*
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );
*/
?>