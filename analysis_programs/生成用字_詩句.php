<?php
require_once( '常數.php' );
require_once( 杜甫資料庫 . '詩句.php' );
require_once( 杜甫資料庫 . '用字_頻率.php' );

$char_line = array();
$chars = array_keys( $用字_頻率 );

foreach( $chars as $char )
{
	$ch_l = array();
	
	foreach( $詩句 as $l )
	{
		if( mb_strpos( $l, $char ) !== false )
		{
			array_push( $ch_l, $l );
		}
	}
	
	if( !empty( $ch_l ) )
	{
		$char_line[ $char ] = $ch_l;
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成用字_詩句.php
說明：單字=>含有該字的詩句。
*/
\$用字_詩句=array(\n";

foreach( $char_line as $char => $lines )
{
	$code = $code . '"' . $char . "\"=>array(";
	$has_line = false;

	foreach( $lines as $line )
	{
		$has_line = true;
		$code = $code . '"' . $line . "\",";
		//echo $line, "\n";
	}
	if( $has_line )
	{
		$code = substr( $code, 0, -1 );
	}

	$code = $code . "),\n";
}
$code = substr( $code, 0, -2 );
$code = $code . ");\n?>";

file_put_contents( 杜甫資料庫 . '用字_詩句.php', $code );
file_put_contents( 杜甫分析文件夾 . '用字_詩句.php', $code );

?>