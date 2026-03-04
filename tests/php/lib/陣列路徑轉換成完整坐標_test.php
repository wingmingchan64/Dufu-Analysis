<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\陣列路徑轉換成完整坐標_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidPathException;
use Dufu\Exceptions\InvalidCoordinateException;

設定測試檔( basename( __FILE__ ) );
$debug = false;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認相等( 陣列路徑轉換成完整坐標( array( '0003', '3', '1' ) ), '〚0003:3.1〛', "case#: ${i}" );
$i++;
確認相等( 陣列路徑轉換成完整坐標( array( '0013', '1', '5', '2', '3' ) ), '〚0013:1:5.2.3〛', "case#: ${i}" );

// 003 不是四位數字
$i++;
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '2', '3', '1' ) ); }, InvalidPathException::class, "case#: ${i}" );
// 0002 不存在
$i++;
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '0002', '3', '1' ) ); }, InvalidPathException::class, "case#: ${i}" );
// 行碼 13 不存在
$i++; // 5
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '0003', '13', '1' ) ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;

confirm_throw( function(){ 
	convert_array_path_to_complete_coords( 
		array( '0003', '13', '1' ) ); }, 
		InvalidCoordinateException::class, "case#: ${i}" );
?>