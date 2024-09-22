<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\create_蕭系目錄template.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 頁碼_詩題 );

$content = '';

foreach( $頁碼_詩題 as $頁碼 => $詩題 )
{
	$content .= $詩題 . ' // ' . $頁碼 . " " . NL;
}


$outfile = 杜甫資料庫 . "\\" . "蕭系目錄template.txt";
file_put_contents( $outfile, $content );
$outfile = 杜甫分析文件夾 . "\\" . "蕭系目錄template.txt";
file_put_contents( $outfile, $content );
?>

