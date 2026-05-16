<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取路徑句字數_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidPathException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
print_r( 提取路徑句字數( '3955,4,118,1' ) );

echo 是默認無字碼路徑( '3955,4,118,1' ) ? '無字碼' : '有字碼', NL;
echo 是默認無字碼路徑( '0003,4,1,3-5' ) ? '無字碼' : '有字碼', NL;

/*
$i++;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
// need to figure out why no InvalidPathException thrown
確認會丟( function(){ 
	替換路徑字( 
		$樹,
		array( '0002', '3', '1', '5' ), "Hi" );
	}, TypeError::class, "case#: ${i}" );
*/
?>