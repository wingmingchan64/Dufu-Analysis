<?php
/*
php H:\github\Dufu-Analysis\tools\php\tests\是合法詩文Test.php
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

顯示布爾値( 是合法詩文( '鬼神' ), '「鬼神」是合法詩文:' );
顯示布爾値( 是合法詩文( '為' ), '「為」是合法詩文:' );
顯示布爾値( 是合法詩文( '軌' ), '「軌」是合法詩文:' );
顯示布爾値( 是合法詩文( '軌道' ), '「軌道」是合法詩文:' );
?>