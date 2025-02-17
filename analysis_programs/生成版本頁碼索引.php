<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成版本頁碼索引.php 蕭
php h:\github\Dufu-Analysis\analysis_programs\生成版本頁碼索引.php 全
php h:\github\Dufu-Analysis\analysis_programs\生成版本頁碼索引.php 今
php h:\github\Dufu-Analysis\analysis_programs\生成版本頁碼索引.php 譯
php h:\github\Dufu-Analysis\analysis_programs\生成版本頁碼索引.php 仇

蕭滌非主編《杜甫全集校注》缺1989
《全唐詩》缺2828，2845，5503
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
$result = array();

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成版本頁碼索引.php
說明：不同注本頁碼。
*/
\$頁碼_${簡稱}頁碼=array(\n";
$count = 0;

// changed after 仇, use 目錄 instead
$file = "H:\\github\\Dufu-Analysis\\${書名}\\${簡稱}目錄.txt";
$lines = explode( NL, file_get_contents( $file ) );
//print_r( $lines );
foreach( $lines as $line )
{
	if( $line == '' || mb_strpos( $line, '//' ) === false )
	{
		continue;
	}
	$parts = explode( '//', $line );
	$parts = trim( $parts[ 1 ] );
	$parts = explode( ' ', $parts );
	$頁碼 = trim( $parts[ 0 ] );
	$版本頁碼 = trim( $parts[ 1 ] );
	$result[ $頁碼 ] = $版本頁碼;
}
$頁碼s = array_keys( $result );
sort( $頁碼s );
foreach( $頁碼s as $頁碼 )
{
	$line = "\"${頁碼}\"=>\"${result[$頁碼]}\",\r\n";
	$code .= $line;
}
/*
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
*/
//echo $count, "\n";
$code = $code . ");\n?>";
file_put_contents( 杜甫資料庫 . $書名 . "\\${書名}頁碼索引.php", $code );
file_put_contents( 杜甫分析文件夾 . $書名 . "\\${書名}頁碼索引.php", $code );
?>

