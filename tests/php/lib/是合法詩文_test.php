<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是合法詩文_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\JsonFileNotFoundException;

設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認爲眞( 是合法詩文( '鬼神' ), "case#: ${i}" );
$i++;
確認爲眞( 是合法詩文( '為' ), "case#: ${i}" );
$i++;
確認爲眞( 是合法詩文( '軌' ), "case#: ${i}" );
$i++;
確認爲眞( !是合法詩文( '軌道' ), "case#: ${i}" );
?>