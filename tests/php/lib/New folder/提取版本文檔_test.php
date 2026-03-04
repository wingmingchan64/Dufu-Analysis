<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取版本文檔_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$詩陣列 = 提取版本文檔( '全', '0098' );
$詩陣列詩文 = 提取詩陣列詩文( $詩陣列, true, true );
$詩題 = "# " . 加sub標簽( $詩陣列詩文[ 0 ] );
unset( $詩陣列詩文[ 0 ] );

$詩題 = $詩題 . NL . NL;
$詩文 = 加sub標簽( implode( NL, $詩陣列詩文 ) );
$contents = $詩題 . $詩文;

file_put_contents(
	dirname( __DIR__, 3 ) . DS . PACKAGES_DIR . 
	'《全唐詩》' . DS . 'samples' . DS . '0098.md',
	$contents . PHP_EOL );

 

/*
確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
確認爲眞( 是合法詩文( '為' ), 'case#: 2' );
確認爲眞( 是合法詩文( '軌' ), 'case#: 3' );
確認爲眞( !是合法詩文( '軌道' ), 'case#: 4' );
*/
?>