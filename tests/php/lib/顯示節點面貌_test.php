<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\顯示節點面貌_test.php
*/
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidAnchorValueException;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$tree = json_decode(
	file_get_contents( 'H:\github\CanonicalTextTrees\corpus\dufu\資料匯總\views\0943.json' ), true );

顯示節點面貌( $tree, '0943,3,a,蕭' );
?>