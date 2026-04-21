<?php
/*
php h:\github\Dufu-Analysis\tools\php\bin\base_text\生成組詩樹.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
$組詩_副題 = 提取數據結構( 組詩_副題 );
//$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
$組詩樹 = array();

foreach( $組詩_副題 as $碼 => $details )
{
	$組詩樹[ $碼 ] = [];
	
	foreach( $details as $k => $v )
	{
		if( $k == 詩題 )
		{
			$組詩樹[ $碼 ][ $k ] = $v;
		}
		else
		{
			$正文樹 = 提取基準正文樹( $碼 . '-' . $k );
			$組詩樹[ $碼 ][ $k ] = $正文樹[ $碼 ][ $k ];
		}
	}
}

//print_r( $組詩樹 );
$json = json_encode(
	$組詩樹,
	JSON_UNESCAPED_UNICODE // | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS .
	SCHEMAS_JSON_BASE_TEXT_DIR .
	'組詩樹.json',
	$json . PHP_EOL );
	
foreach( $組詩樹 as $文檔碼 => $子樹 )
{
	$json = json_encode(
		array( $文檔碼 => $組詩樹[ $文檔碼 ] ),
		JSON_UNESCAPED_UNICODE // | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS .
		SCHEMAS_JSON_BASE_TEXT_DIR .
		$文檔碼 . '.json',
		$json . PHP_EOL );
}
?>

