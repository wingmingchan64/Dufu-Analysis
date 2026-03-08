<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩碼樹文字內容_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\JsonFileNotFoundException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$詩碼 = '0013-1';
$樹 = 提取數據結構( BASE_TEXT_DIR . $詩碼 );
插入路徑字( $樹, 
	完整坐標轉換成路徑列陣( '〚0013:1:7.1.6〛' ), "Hi" );
//print_r( $樹 );
echo 提取詩碼樹文字內容( '0013-1', $樹, $debug );

	/*
$i = 1;
確認爲眞( is_array( 提取目錄( '《全唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" ) ), "case#: ${i}");	
$i++;
確認相等( 提取目錄( '《全唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" )[ '6500' ], '1139',  "case#: ${i}" );
$i++;
確認會丟( function(){ get_catalog( '《唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" ); }, JsonFileNotFoundException::class, "case#: ${i}" );*/
?>