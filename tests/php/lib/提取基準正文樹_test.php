<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取基準正文樹_test.php
*/
$debug = true;
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\PoemIDNotFoundException;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認爲眞( is_array( 提取基準正文樹( '0003' ) ), "case#: ${i}" );
$i++;
確認相等( array_keys( 提取基準正文樹( '0003' ) )[ 0 ],
	'0003', "case#: ${i}" );
$i++;
確認會丟( function(){ 提取基準正文樹( "0002" ); }, PoemIDNotFoundException::class, "case#: ${i}" );
?>