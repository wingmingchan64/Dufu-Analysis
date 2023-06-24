<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成版本目錄.php 蕭
php h:\github\Dufu-Analysis\analysis_programs\生成版本目錄.php 全
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );
require_once( 杜甫資料庫 . '頁碼.php' );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供書目簡稱。", "\n";
	exit;
}
$簡稱 = trim( $argv[ 1 ] );
$書名 = $書目簡稱[ '=' . $簡稱 ];
//echo $書名, "\n";
$頁碼_版本頁碼 = array();
$陣列命 = $簡稱 . "内容";

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成版本目錄.php
說明：不同注本頁碼。
*/
\$頁碼_版本頁碼=array(\n";
$count = 0;
foreach( $頁碼 as $頁 )
{
	$path = 杜甫資料庫 . $書名 . "\\${頁}.php";
	
	if( file_exists( $path ) )
	{
		require_once( $path );
		$首行 = $$陣列命[ 書名 ];
		$首行 = str_replace( $書名, '', $首行 );
		//echo "$頁=>", $首行, "\n";
		$code = $code . "\"${頁}\"=>\"${首行}\",\n";
	}
	else
	{
		//echo "缺 $頁\n";
		$count++;
	}
}
echo $count, "\n";
$code = $code . ");\n?>";
//file_put_contents( 杜甫資料庫 . $書名 . "\\${書名}目錄.php", $code );
?>

