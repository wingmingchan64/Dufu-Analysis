<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\處理後設標記_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$全文檔碼_全詩碼 = 提取目錄( '《全唐詩》' . DS . 'catalog' . DS .
	'全文檔碼_全詩碼' );
$全詩碼 = $全文檔碼_全詩碼[ '0098' ];
print_r( $全詩碼 );

foreach( $全詩碼 as $詩碼 )
{
	處理後設標記( '全', $詩碼, '中華書局版', true, true );
}




/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );

array_push( $test_results, "是合法詩文_test: 4 cases tested." );
*/
?>