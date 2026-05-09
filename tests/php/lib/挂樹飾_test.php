<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\挂樹飾_test.php
*/
use CTT\Exceptions\IllegalWorkIDException;
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidAnchorValueException;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

挂樹飾( '0042', 'JINGQUAN,0001' );
?>