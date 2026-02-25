<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\含範圍字碼完整坐標轉換成路徑列陣_test.php
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
confirm_identical( 
	sizeof( convert_complete_coords_with_scoped_char_to_path_array( '〚0003:5.1.2-4〛' ) ), 3, "case#: ${i}" );
$i++;
確認相等( 含範圍字碼完整坐標轉換成路徑列陣( '〚0003:5.1.2-4〛' )[ 2 ],
	array( '0003', '5', '1', '4' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 確認相等( 含範圍字碼完整坐標轉換成路徑列陣( '〚0004:5.1.2-4〛' )[ 2 ],
	array( '0003', '5', '1', '4' ) ); }, InvalidCoordinateException::class, "case#: ${i}" );
?>