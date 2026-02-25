<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\含範圍字碼完整坐標轉換成坐標列陣_test.php
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
確認相等(convert_complete_coords_with_scoped_char_to_array_of_coords( '〚6093:5.2.2-3〛' ),
	array( '〚6093:5.2.2〛', '〚6093:5.2.3〛' ), "case#: ${i}" );
$i++;
確認相等( convert_complete_coords_with_scoped_char_to_array_of_coords( '〚6093:5.2.2-3〛' ),
	array( '〚6093:5.2.2〛', '〚6093:5.2.3〛' ), "case#: ${i}" );
$i++;
確認相等( 含範圍字碼完整坐標轉換成坐標列陣( '〚6093:5.2.2〛' ),
 array( '〚6093:5.2.2〛' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 含範圍字碼完整坐標轉換成坐標列陣( '〚6094:5.2.2-3〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認會丟( function(){ 含範圍字碼完整坐標轉換成坐標列陣( '〚6093:5.2.3-3〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
?>