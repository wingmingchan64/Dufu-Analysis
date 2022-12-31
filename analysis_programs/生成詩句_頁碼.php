<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
$out_file  = 'h:\github\Dufu-Analysis\詩句_頁碼.php';
$code      = "<?php
/*
生成：本文檔用 PHP 生成。
說明：單句詩句=>頁碼。
*/
\$詩句_頁碼=array(\n";
//$count = 0;

foreach( $頁碼 as $p )
{
	$path = 詩集文件夾 . $p . ".php";
	require_once( $path );
	$line = $内容[ "詩句" ];
	
	foreach( $line as $l )
	{
		$code = $code . "\"" . $l . "\"=>\"" .
			$p . "\",\n";
	}
}
$code = substr( $code, 0, -1 );
$code = $code . "\n);\n?>";
file_put_contents( $out_file, $code );
?>