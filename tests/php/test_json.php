<?php
/*
php H:\github\Dufu-Analysis\tests\php\test_json.php
*/
$debug = true;

use Dufu\Exceptions\JsonDecodeException;
//use JsonException;

require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

try
{
	提取測試結構( '不對' );
}
catch( JsonDecodeException $e )
{
	echo $e->getMessage();
	
}

?>