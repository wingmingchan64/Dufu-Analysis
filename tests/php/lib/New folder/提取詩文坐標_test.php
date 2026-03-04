<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩文坐標_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認爲眞( sizeof( 提取詩文坐標( '如何' ) ) == 23, "case#: {$i}" );
$i++;
確認相等( 提取詩文坐標( '杜子' )[ 0 ], '〚0943:4.1.1-2〛', "case#: {$i}" );
$i++;
確認會丟( function(){ 提取詩文坐標( '詭異' ); }, InvalidPoemFragmentException::class, "case#: ${i}" );
?>