<?php
/*
php H:\github\Dufu-Analysis\tools\php\test\常數Test.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"tools" . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"常數.php" );

require_once( PHP_GLOBAL_FUNCTIONS );

try
{
	throw new InvalidCoordinateException( '「Just a test of 常數。」' );
}
catch( InvalidCoordinateException $e )
{
	echo $e, NL;
	echo '「完成測試。」', NL;
}
?>