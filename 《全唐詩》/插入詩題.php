<?php
/*
php h:\github\Dufu-Analysis\《全唐詩》\插入詩題.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );
$content = file_get_contents(
'H:\github\Dufu-Analysis\《全唐詩》\全目錄.txt' );
$lines = explode( NL, $content );
$content = '';

foreach( $lines as $line )
{
	$文檔碼 = mb_substr( $line, 0, 4 );
	$詩題 = $默認詩文檔碼_詩題[ $文檔碼 ];
	echo $詩題, NL;
	$content .= $詩題 . ' ' . '// ' . $line . NL;
}
echo $content;
?>