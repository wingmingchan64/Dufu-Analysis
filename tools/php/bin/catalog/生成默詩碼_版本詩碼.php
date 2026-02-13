<?php

/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成默詩碼_版本詩碼.php
*/
require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

// change this value
$簡稱 = '蕭';

$書目簡稱 = 提取數據結構( 書目簡稱 );
$書名 = $書目簡稱[ $簡稱 ];
$目錄名 = $書名 . DS . "${簡稱}目錄";
$版本目錄 = 提取目錄( $目錄名 );

$默_版名 = '默詩碼_' . $簡稱 . '詩碼';
$版_默名 = $簡稱 . '詩碼_' . '默詩碼';
$默_版 = array();
$版_默 = array();

foreach( $版本目錄 as $版詩碼 => $條目 )
{
	$默詩碼 = $條目[ "默詩碼" ];
	$版詩碼 = $條目[ "${簡稱}詩碼" ];
	$默_版[ $默詩碼 ] = $版詩碼;
	$版_默[ $版詩碼 ] = $默詩碼;
}
ksort( $默_版 );
$默_版名 = '默詩碼_' . $簡稱 . '詩碼';
$版_默名 = $簡稱 . '詩碼_' . '默詩碼';

//exit;
$json = json_encode(
    $默_版,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
	$默_版名 . '.json',
	$json . PHP_EOL );

$json = json_encode(
    $版_默,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
	$版_默名 . '.json',
	$json . PHP_EOL );

?>

