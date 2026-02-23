<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\含範圍字碼完整坐標轉換成路徑列陣_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

confirm_identical( 
	sizeof( convert_complete_coords_with_scoped_char_to_path_array( '〚0003:5.1.2-4〛' ) ), 3, 'case#: 1' );
確認同一( 含範圍字碼完整坐標轉換成路徑列陣( '〚0003:5.1.2-4〛' )[ 2 ],
	array( '0003', '5', '1', '4' ), 'case#: 2' );
確認會丟( function(){ 確認同一( 含範圍字碼完整坐標轉換成路徑列陣( '〚0004:5.1.2-4〛' )[ 2 ],
	array( '0003', '5', '1', '4' ), 'case#: 3' ); }, InvalidCoordinateException::class, 'case#: 4' );

array_push( $test_results, "只有詩碼行碼句碼之完整坐標_test: 4 cases tested." );
?>