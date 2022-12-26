<?php
require_once( 'h:\github\Dufu-Analysis\normalized.php' );

if( $text )
{
	$lines = mb_split( "。", $text );
$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：本文檔儲存一句一句的詩句。
*/
\$詩句=array(\n";
	
	foreach( $lines as $line )
	{
		if( $line == '' )
			continue;
		$code = $code . '"' . $line . "\",\n";
	}
	// truncate last ,\n
	$code = substr( $code, 0, -2 );
	$code = $code . ");\n?>";
	file_put_contents( 'h:\github\Dufu-Analysis\詩句.php', $code );
}
?>