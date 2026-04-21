<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\添加錨_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidPathException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$樹 = 提取基準正文樹( '0003' );


添加標點符號( $樹 );
添加錨( $樹 );
print_r( $樹 );
/*
$樹[ '0003' ][ '詩題' ][ '1' ] = 'mong6 ngok6';
//print_r( $樹[ '0003' ][ '詩題' ][ '0' ] );
print_r( $樹 );
echo NL;
*/
/*
$樹 = 提取基準正文樹( '0013' );
添加標點符號( $樹 );
添加錨( $樹 );
print_r( json_encode( $樹, JSON_UNESCAPED_UNICODE ) );
*/
//array &$陣列, array $路徑, int $開始=0, string $字='',
/*
$i = 1;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
//確認爲眞(
	替換路徑字( $樹, 
		array( '0003', '3', '1', '5' ), "Hi" );//, "case#: ${i}" //);
print_r( $樹 );
*/
/*
$i++;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
// need to figure out why no InvalidPathException thrown
確認會丟( function(){ 
	替換路徑字( 
		$樹,
		array( '0002', '3', '1', '5' ), "Hi" );
	}, TypeError::class, "case#: ${i}" );
*/
?>