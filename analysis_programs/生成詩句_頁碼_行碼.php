<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '詩句_頁碼.php' );
$out_file  = 杜甫資料庫 . '詩句_頁碼_行碼.php';
$code      = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句_頁碼_行碼.php
說明：詩句=>（頁碼，行碼）。
*/
\$詩句_頁碼_行碼=array(\n";

foreach( $詩句_頁碼 as $l => $p )
{
	$path = 詩集文件夾 . $p . ".php";
	require_once( $path );
	$ln_array = $内容[ "行碼" ];
	
	// search for the line
	$pln = "";
	foreach( $ln_array as $ln => $dl )
	{
		// find the first instance in the ln
		if( mb_strpos( $dl, $l ) !== false )
		{
			$pln = $ln ;
			break;
		}
	}
	
	$code = $code . "\"" . $l . "\"=>array(" .
		"\"" . $p . "\",\"" . $pln . "\"),\n";
}
$code = substr( $code, 0, -1 );
$code = $code . "\n);\n?>";
file_put_contents( $out_file, $code );
?>