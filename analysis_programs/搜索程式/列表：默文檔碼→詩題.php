<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\列表：默文檔碼→詩題.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

echo "默文檔碼→詩題列表" . NL . NL;
foreach( $默認詩文檔碼_詩題 as $文檔碼 => $詩題 )
{
	echo $文檔碼, ' ' . $詩題 . NL;
}
?>