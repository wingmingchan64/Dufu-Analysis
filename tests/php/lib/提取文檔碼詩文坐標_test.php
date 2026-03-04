<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取文檔碼詩文坐標_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\DocumentIDNotFoundException;
use Dufu\Exceptions\PoemFragmentNotFoundException;

設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認爲眞( 是合法完整坐標( 提取文檔碼詩文坐標( '3', '如何' )[ 0 ] ), "case#: {$i}" );
$i++;
確認相等( 提取文檔碼詩文坐標( '3', '如何' )[ 0 ], '〚0003:3.1.4-5〛', "case#: {$i}" );
$i++;
確認會丟( function(){ 提取文檔碼詩文坐標( '〚13:〛', '如何' ); }, DocumentIDNotFoundException::class, "case#: {$i}" );
?>