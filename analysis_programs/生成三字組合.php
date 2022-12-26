<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( "h:\\github\\Dufu-Analysis\\詩句.php" );

$three_char_combo = array();

foreach( $詩句 as $l )
{
	$len = mb_strlen( $l );
	$count = 0;
	
	while( $count < $len - 2 )
	{
		$key = mb_substr( $l, $count, 3 );
		
		if( !array_key_exists( $key, $three_char_combo ) )
		{
			$three_char_combo[ $key ] = 1;
		}
		else
		{
			$three_char_combo[ $key ] ++;
		}
		$count++;
	}
}

/*
$code = "<?php\n\$three_char_combo=array(\n";

foreach( $three_char_combo as $p => $f )
{
	$code = $code . "\"${p}\"=>$f,\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";

file_put_contents( "h:\\github\\Dufu-Analysis\\three_char_combo.php", $code );
*/

$sorted_p_frequency = array();

foreach( $three_char_combo as $key => $value )
{
	if( !array_key_exists( $value, $sorted_p_frequency ) )
	{
		$sorted_p_frequency[ $value ] = array( $key );
	}
	else
	{
		array_push( $sorted_p_frequency[ $value ], $key );
	}
}

krsort( $sorted_p_frequency );

$code = "";

foreach( $sorted_p_frequency as $key => $value )
{
	$code = $code . $key . '=>array(';
	
	foreach( $sorted_p_frequency[ $key ] as $char )
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
說明：出現頻率=>三字組合，按頻率高低排序。
*/
\$三字組合排序頻率=array(\n" . $code . ");\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\三字組合排序頻率.php', $code );

?>
