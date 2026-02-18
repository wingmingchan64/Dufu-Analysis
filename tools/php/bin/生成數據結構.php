<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\生成數據結構.php
*/

require_once(
	dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

// 1457 files in base_text
require( 'base_text\生成杜甫詩陣列.php' );
// 3 files
require( 'ids\生成默認詩文檔碼.php' );
require( 'ids\生成默認版本詩碼.php' );

?>