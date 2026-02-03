<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\列表：杜甫詩全集.php
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

foreach( $默認詩文檔碼 as $默文檔碼 )
{
	$詩文文檔路徑 = 默認版本詩文件夾 . $默文檔碼 . '.txt';
	echo NL, file_get_contents( $詩文文檔路徑 ) . NL;
}
?>