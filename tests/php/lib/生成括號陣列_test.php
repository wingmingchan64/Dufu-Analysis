<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\生成括號陣列_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidCoordinateException;
//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

print_r( 生成括號陣列( '<>' ) );
print_r( 生成括號陣列( '《》' ) );
print_r( 生成括號陣列( '' ) );

/*
$i = 1;
確認會丟( function(){ 提取首碼( '〚0013:〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認相等( 提取首碼( '〚0013:2:〛' ), '2', "case#: ${i}" );
$i++;
確認會丟( function(){ 
	提取首碼( '〚001:〛' ); }, 
	InvalidCoordinateException::class, "case#: ${i}" );
*/
?>