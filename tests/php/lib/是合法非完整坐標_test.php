<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是合法非完整坐標_test.php
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
確認爲眞( 是合法非完整坐標( '〚1:〛' ), "case#: ${i}" );
$i++;
確認爲眞( 是合法非完整坐標( '〚3〛' ), "case#: ${i}" );
$i++;
確認爲眞( 是合法非完整坐標( '〚3:18〛' ), "case#: ${i}" );
$i++;
確認爲眞( 是合法非完整坐標( '〚3.1.5-7〛' ), "case#: ${i}" );
$i++;
確認爲眞( !是合法非完整坐標( '〚2.1〛' ), "case#: ${i}" );
?>