<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\完整坐標轉換成路徑列陣_test.php
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
確認相等( 完整坐標轉換成路徑列陣( '〚6093:5.2.3〛' ), 
	array( '6093', '5', '2', '3' ), "case#: ${i}" );
$i++;
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6093:5.2.3-4〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6094:5.2.3〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認會丟( function(){ convert_complete_coords_to_path_array( '〚6093:5.2.13〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
?>