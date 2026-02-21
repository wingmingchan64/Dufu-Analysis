<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩陣列詩文_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
// array starts with 0013
$詩陣列 = 提取詩陣列( '〚0013:1:〛' );
//$詩陣列 = 提取數據結構( BASE_TEXT_DIR . '0013-1' );
echo implode( NL, 提取詩陣列詩文( $詩陣列, true, true, false ) );
echo NL, NL;
$詩陣列 = 提取詩陣列( '〚0003:〛' );
echo implode( NL, 提取詩陣列詩文( $詩陣列, false, false ) );



/*
確認爲眞( 是默認版本詩碼( '0003' ), 'case#: 1' );
確認爲眞( !是默認版本詩碼( '0004' ), 'case#: 2' );
確認爲眞( !是默認版本詩碼( '0013' ), 'case#: 3' );
確認爲眞( 是默認版本詩碼( '0013-2' ), 'case#: 4' );
確認爲眞( 是默認版本詩碼( '13-2' ), 'case#: 5' );

array_push( $test_results, "是默認版本詩碼_test: 5 cases tested." );
*/
?>