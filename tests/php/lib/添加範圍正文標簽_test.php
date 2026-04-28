<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\添加範圍正文標簽_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidPathException;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );


$樹 = 提取詩碼基準正文樹( '0003' );
$brackets = 生成括號陣列( '《》' );
add_tag_to_scope( $樹, '0003,6,2,3-5', 
	$brackets[ 0 ], $brackets[ 1 ] );
add_punctuation( $樹 );
add_anchors( $樹 );
print_r( $樹 );

?>