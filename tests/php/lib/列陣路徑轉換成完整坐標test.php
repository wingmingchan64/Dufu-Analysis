<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\列陣路徑轉換成完整坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );


確認同一( 列陣路徑轉換成完整坐標( array( '0003', '3', '1' ) ), '〚0003:3.1〛', 'case#: 1' );
確認同一( 列陣路徑轉換成完整坐標( array( '0013', '1', '5', '2', '3' ) ), '〚0013:1:5.2.3〛', 'case#: 2' );

// 003 不是四位數字
確認會丟( function(){ 列陣路徑轉換成完整坐標( array( '003', '3', '1' ) ); }, InvalidPathException::class, 'case#: 3' );
// 0002 不存在
確認會丟( function(){ 列陣路徑轉換成完整坐標( array( '0002', '3', '1' ) ); }, InvalidPathException::class, 'case#: 4' );
// 行碼 13 不存在
確認會丟( function(){ 列陣路徑轉換成完整坐標( array( '0003', '13', '1' ) ); }, InvalidCoordinateException::class, 'case#: 5' );
確認會丟( function(){ 列陣路徑轉換成完整坐標( array( '0003', '13', '1' ) ); }, InvalidCoordinateException::class, 'case#: 5' );

confirm_throw( function(){ 
	convert_array_path_to_complete_coords( 
		array( '0003', '13', '1' ) ); }, 
		InvalidCoordinateException::class, 'case#: 6' );

array_push( $test_results, "是合法詩文_test: 6 cases tested." );
?>