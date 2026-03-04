<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是含範圍字碼完整坐標_test.php
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
確認爲眞( !是含範圍字碼完整坐標( '〚1:〛' ), "case#: ${i}" );
$i++;
確認爲眞( !是含範圍字碼完整坐標( '〚1:5〛' ), "case#: ${i}" );
$i++;
確認爲眞( !是含範圍字碼完整坐標( '〚0013:1:5〛' ), "case#: ${i}" );
確認爲眞( !是含範圍字碼完整坐標( '〚0013:1:5.1〛' ), "case#: ${i}" );
確認爲眞( !是含範圍字碼完整坐標( '〚0013:1:5.1.2〛' ), "case#: ${i}" );
確認爲眞( 是含範圍字碼完整坐標( '〚0013:1:5.1.2-4〛' ), "case#: ${i}" );
確認爲眞( !是含範圍字碼完整坐標( '〚0013:1:5-6〛' ), "case#: ${i}" );
?>