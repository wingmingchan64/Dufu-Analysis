<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\文賦\process_prose.php
*/
require_once( 
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$文檔碼 = '6111';
$filepath = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
	默認版本文賦文件夾 . "${文檔碼}.txt";
$file_contents = file_get_contents( $filepath );
//$行s = explode( NL.NL, $file_contents );
$文字塊 = 生成文字塊( $file_contents );
//echo mb_strlen( $文字塊 );
$樹骨架 = array();
$題 = 生成樹骨架( $文檔碼, $file_contents, $樹骨架 );
//print_r( $樹骨架 );
$位置 = array( 0 );
$順序樹 = array();

for( $i = 0; $i < mb_strlen( $文字塊 ); $i++ )
{
	$碼 = $i + 1;
	$順序樹[ "$碼" ] = mb_substr( $文字塊, $i, 1 );
}

//print_r( json_encode( $順序樹, JSON_UNESCAPED_UNICODE ) );
$樹 = 生成空樹( $文檔碼, $題, $樹骨架 );
$位置[ 0 ] = mb_strlen( $題 ); // skip title
$路徑_順序碼   = array();
$路徑 = '';

空樹末端節點塡文字( $文字塊,$樹,$順序樹,$路徑_順序碼,$路徑,$位置 );
print_r( json_encode( $樹, 
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
//print_r( $map );
//print_r( $順序樹 );
?>