<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\test_splitting.php
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

$文檔碼 = '0013-1';
$樹 = 提取基準正文樹( $文檔碼 );
//添加末端錨( $樹 );

//添加標點符號( $樹 );
//添加錨( $樹 );
//print_r( $樹 );
print_r( 提取樹行路徑( $樹 ));
?>