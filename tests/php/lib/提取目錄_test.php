<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取目錄_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
	
確認爲眞( is_array( 提取目錄( '《全唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" ) ) );	

/*
確認同一( 陣列路徑轉換成完整坐標( array( '0003', '3', '1' ) ), '〚0003:3.1〛', 'case#: 1' );
確認同一( 陣列路徑轉換成完整坐標( array( '0013', '1', '5', '2', '3' ) ), '〚0013:1:5.2.3〛', 'case#: 2' );

// 003 不是四位數字
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '003', '3', '1' ) ); }, InvalidPathException::class, 'case#: 3' );
// 0002 不存在
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '0002', '3', '1' ) ); }, InvalidPathException::class, 'case#: 4' );
// 行碼 13 不存在
確認會丟( function(){ 陣列路徑轉換成完整坐標( array( '0003', '13', '1' ) ); }, InvalidCoordinateException::class, 'case#: 5' );

confirm_throw( function(){ 
	convert_array_path_to_complete_coords( 
		array( '0003', '13', '1' ) ); }, 
		InvalidCoordinateException::class, 'case#: 6' );
*/
?>