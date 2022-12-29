<?php
require_once( 'h:\github\Dufu-Analysis\詩文件夾路徑.php' );
require_once( '常數.php' );
require_once( '函式.php' );

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
				//array_push( $頁碼_詩題, $file );
				$頁碼_詩題[ substr( $file, 0, 4 ) ] =
					substr( $file, 5, -4 );
			}
		}
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：頁碼=>詩題。
*/
\$頁碼_詩題=array(\n";
foreach( $頁碼_詩題 as $p => $t )
{
	$code = $code . '"' . $p . "\"=>\"$t\",\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\頁碼_詩題.php', $code );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：詩題=>頁碼。
*/
\$詩題_頁碼=array(\n";
foreach( $頁碼_詩題 as $p => $t )
{
	$code = $code . '"' . $t . "\"=>\"$p\",\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\詩題_頁碼.php', $code );

?>