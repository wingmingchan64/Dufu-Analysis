<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成異體字.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
require_once( __DIR__ . DS . '異體字.php' );

$json = json_encode(
    $異體字,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_REGISTRY_DIR .
	'異體字.json',
	$json . PHP_EOL );
?>