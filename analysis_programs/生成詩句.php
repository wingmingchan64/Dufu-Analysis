<?php
require_once( '常數.php' );
require_once( 杜甫資料庫 . 'normalized.php' );

if( $text )
{
	$lines = mb_split( "。", $text );
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句.php
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
	file_put_contents( 杜甫資料庫 . '詩句.php', $code );
}
?>