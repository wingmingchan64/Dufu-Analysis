<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\文賦\生成文賦正文樹.php
*/
require_once( 
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$文檔碼s = array(
	'6124'
);

/*
$文檔碼s = array(
	'6111','6124','6131','6165','6193','6240','6248',
	'6270','6278','6293','6301'
);
*/

foreach( $文檔碼s as $文檔碼 )
{
	$filepath = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
		默認版本文賦文件夾 . "${文檔碼}.txt";
	$file_contents = file_get_contents( $filepath );
	$文字塊 = 生成文字塊( $file_contents );
	$順序樹 = 生成順序樹( $文字塊 );
	/*
	$順序樹["32"] = '跡';
	print_r( 
		json_encode( $順序樹, JSON_UNESCAPED_UNICODE ) );
	*/
	$樹骨架 = array();
	生成樹骨架( $文檔碼, $file_contents, $樹骨架 );
	/*
	print_r(
		json_encode( $樹骨架, JSON_UNESCAPED_UNICODE ) );
	*/
	$位置 = array( 0 );
	$題 = 文賦篇名[ $文檔碼 ];
	//echo $題, NL;
	$樹 = 生成空樹( $文檔碼, $題, $樹骨架 );
	//print_r( $樹 );
	$位置[ 0 ] = mb_strlen( $題 ); // skip title
	$路徑_順序碼   = array();
	$路徑 = '';
	空樹末端節點塡文字( $文字塊,$樹,$順序樹,$路徑_順序碼,$路徑,$位置 );
	print_r( $樹 );
	$filepath = dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR .
		SCHEMAS_JSON_BASE_TEXT_DIR . "${文檔碼}.json";
	生成JSON文檔( $樹, $filepath );
}
?>