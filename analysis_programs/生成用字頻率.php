<?php
require_once( 'h:\github\Dufu-Analysis\normalized.php' );
$c_out_path = 'h:\github\Dufu-Analysis\用字_頻率.php';

if( $text )
{
	$chars = mb_str_split( trim( $text ) );
	$frequency = array();

	foreach( $chars as $char )
	{
		if( $char === "。" || $char === "" )
			continue;
		if( !array_key_exists( $char, $frequency ) )
		{
			$frequency[ $char ] = 1;
		}
		else
		{
			$frequency[ $char ] ++;
		}
	}

	$code = "";
	
	foreach( $frequency as $key => $value )
	{
		$code = $code . 
			'"' . $key . '"' . '=>' . $value . ",\n";
	}
	// truncate last ,\n
	$code = substr( $code, 0, -2 );
		
$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：單字=>詩中用此字的頻率，統計的資料來自 normalized.php。
*/
\$用字_頻率=array(\n" . $code . ");\n?>";
	// write file
	file_put_contents( $c_out_path, $code );
}
?>