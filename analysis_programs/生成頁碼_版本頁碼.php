<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成頁碼_版本頁碼.php
*/
require_once( "函式.php" );
require_once( 書目簡稱 );

$簡稱 = '謝';
$路徑 = 杜甫分析文件夾 . $書目簡稱[ '=' . $簡稱 ] . "\\${簡稱}目錄.txt";
$file = file_get_contents( $路徑 );
$lines = explode( NL, $file );
$counter = 0;
$contents = "<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成頁碼_版本頁碼.php
*/
\$頁碼_${簡稱}頁碼=array(
";

foreach( $lines as $line )
{
	if( $line == '' || strpos( $line, '//' ) === false )
	{
		continue;
	}
	$parts = explode( ' ', $line );
	$默認頁碼 = trim( $parts[ 2 ] );
	$版本頁碼 = trim( $parts[ 3 ] );
	$contents .= "\"$默認頁碼\"=>\"$版本頁碼\",\r\n";
}
$contents .= ");
?>";
file_put_contents( 杜甫分析文件夾 . 
	$書目簡稱[ '=' . $簡稱 ] . "\\頁碼_${簡稱}頁碼.php", $contents );
?>