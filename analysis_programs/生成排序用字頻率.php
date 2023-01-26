<?php
require_once( '常數.php' );
require_once( 杜甫資料庫 . '用字_頻率.php' );

$sorted_char_frequency = array();

foreach( $用字_頻率 as $key => $value )
{
	if( !array_key_exists( $value, $sorted_char_frequency ) )
	{
		$sorted_char_frequency[ $value ] = array( $key );
	}
	else
	{
		array_push( $sorted_char_frequency[ $value ], $key );
	}
}

krsort( $sorted_char_frequency );

$code = "";

foreach( $sorted_char_frequency as $key => $value )
{
	$code = $code . $key . '=>array(';
	
	foreach( $sorted_char_frequency[ $key ] as $char )
	{
		$code = $code . '"' . $char . '",';
	}
	
	// remove last ,
	$code = substr( $code, 0, -1 );
	$code = $code . "),\n";
}

// remove last )\n
$code = substr( $code, 0, -2 );
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成排序用字頻率.php
說明：詩中用此字的頻率=>單字，並按頻率的高低排列。
*/
\$排序頻率_用字=array(\n" . $code . ");\n?>";
file_put_contents( 杜甫資料庫 . '排序頻率_用字.php', $code );
?>