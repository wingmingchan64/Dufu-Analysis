<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\列表：默文檔碼.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

//echo "默文檔碼" . NL . NL;
foreach( $默認詩文檔碼 as $文檔碼 )
{
	echo $文檔碼 . NL;
}
?>