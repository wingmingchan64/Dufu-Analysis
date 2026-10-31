<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\默認版本定位\默文檔碼→文賦.php 6301
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !in_array( $默文檔碼, 文賦默認文檔碼 ) )
{
	echo 無頁碼, NL;
}

$文賦文檔路徑 = $filepath = 
		dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
		SCHEMAS_JSON_BASE_TEXT_DIR . "${默文檔碼}.json";
$文賦 = json_decode(
	file_get_contents( $filepath ), true )
		[ $默文檔碼 ];
foreach( array_keys( $文賦 ) as $key )
{
	if( $key == 篇名 )
	{
		echo $文賦[ $key ], NL . NL;
	}
	else
	{
		顯示文賦段落( $文賦[ $key ] );
	}
}
?>