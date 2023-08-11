<?php
/*

*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '詩文件夾路徑.php' );

$頁碼_詩題 = array();
// get the titles
if( is_dir( 杜甫文件夾 ) )
{
	foreach( $詩文件夾路徑 as $folder )
	{
		// store all text file names
		$files = scandir( $folder );
		
		foreach( $files as $file )
		{
			if( $file != '.' && $file != '..' &&
				str_contains( $file, '.txt' )
			)
			{
				$頁碼_詩題[ substr( $file, 0, 4 ) ] =
					substr( $file, 5, -4 );
			}
		}
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
生成程式： 生成頁碼_詩題.php
說明：頁碼=>詩題。
*/
\$頁碼_詩題=array(\n";
foreach( $頁碼_詩題 as $p => $t )
{
	$code = $code . '"' . $p . "\"=>\"$t\",\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 杜甫資料庫. '頁碼_詩題.php', $code );

$temp = array();

foreach( $頁碼_詩題 as $p => $t )
{
	$p = trim( $p );
	$t = trim( $t );
	
	if( !array_key_exists( $t, $temp ) )
	{
		$temp[ $t ] = $p;
	}
	elseif( is_array( $temp[ $t ] ) )
	{
		array_push( $temp[ $t ], $p );
		//echo "2 " . $temp[ $t ], "\n";
		//
	}
	else // string
	{
		$first = $temp[ $t ];
		$temp[ $t ] = array( $first, $p );
	}
}
//print_r( $temp );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
生成程式： 生成頁碼_詩題.php
說明：詩題=>頁碼。
*/
\$詩題_頁碼=array(\n";
foreach( $temp as $t => $ps )
{
	if( is_string( $ps ) )
	{
	$code = $code . '"' . $t . "\"=>\"${ps}\",\n";
	}
	elseif( is_array( $ps ) )
	{
		$code = $code . '"' . $t . "\"=>array(";
		
		foreach( $ps as $p )
		{
			$code = $code . "\"${p}\",";
		}
		$code = $code . "),\n";
	}
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 杜甫資料庫 . '詩題_頁碼.php', $code );
file_put_contents( 杜甫分析文件夾 . '詩題_頁碼.php', $code );
?>