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
	
$i = 1;
確認爲眞( is_array( 提取目錄( '《全唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" ) ), "case#: ${i}");	
$i++;
確認相等( 提取目錄( '《全唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" )[ '6500' ], '1139',  "case#: ${i}" );
$i++;
確認會丟( function(){ get_catalog( '《唐詩》' .DS . 'catalog'. DS . "默詩碼_全詩碼" ); }, RuntimeException::class, "case#: ${i}" );
?>