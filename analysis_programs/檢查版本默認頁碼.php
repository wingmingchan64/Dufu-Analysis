<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\檢查版本默認頁碼.php
*/
require_once( '函式.php' );
require_once( 頁碼 );
require_once( 書目簡稱 );

$簡稱 = '訳';
$路徑 = 杜甫分析文件夾 . $書目簡稱[ '=' . $簡稱 ] . "\\${簡稱}目錄.txt";
$file = file_get_contents( $路徑 );
$lines = explode( NL, $file );
$counter = 0;

foreach( $lines as $line )
{
	$counter++;
	if( $line == '' || strpos( $line, '//' ) === false )
	{
		continue;
	}
	$parts = explode( ' ', $line );
	$默認頁碼 = trim( $parts[ 2 ] );
	
	if( in_array( $默認頁碼, $頁碼 ) || $默認頁碼 == '6497' )
	{
		continue;
	}
	else
	{
		echo $counter, ' ', $默認頁碼, NL;
		exit;
	}
}
echo "Done", NL;
?>