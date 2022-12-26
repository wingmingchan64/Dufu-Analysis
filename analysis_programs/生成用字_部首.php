<?php
/*
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( "h:\\github\\Dufu-Analysis\\部首_用字.php" );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：杜甫詩中所用字=>部首。
*/
\$用字_部首=array(\n";

foreach( $部首_用字 as $部 => $字s )
{
	foreach( $字s as $字 )
	{
		$code = $code . "\"$字\"=>\"$部\",\n";
	}
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";

file_put_contents( 'h:\github\Dufu-Analysis\用字_部首.php', $code );
?>