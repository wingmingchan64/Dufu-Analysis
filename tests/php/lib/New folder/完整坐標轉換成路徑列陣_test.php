<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\完整坐標轉換成路徑列陣_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認同一( 完整坐標轉換成路徑列陣( '〚6093:5.2.3〛' ), 
	array( '6093', '5', '2', '3' ), 'case#: 1' );
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6093:5.2.3-4〛' ); }, InvalidCoordinateException::class, 'case#: 2' );
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6094:5.2.3〛' ); }, InvalidCoordinateException::class, 'case#: 3' );
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6093:5.2.13〛' ); }, InvalidCoordinateException::class, 'case#: 4' );

array_push( $test_results, "完整坐標轉換成路徑列陣_test: 4 cases tested." );
?>