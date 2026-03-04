<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\行碼坐標轉換成字碼坐標_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

//echo 行碼坐標轉換成字碼坐標( '〚0229:4〛' );
//echo 行碼坐標轉換成字碼坐標( '〚0003:5〛' );
echo 行碼坐標轉換成字碼坐標( '〚0013:1:7〛' );

array_push( $test_results, "是合法錨値_test: 8 cases tested." );

?>