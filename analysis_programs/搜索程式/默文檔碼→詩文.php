<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\默文檔碼→詩文.php 3
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

checkARGV( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fixPageNum( trim( $argv[ 1 ] ) );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無頁碼, NL;
}
$詩文文檔路徑 = 默認版本詩文件夾 . $默文檔碼 . '.txt';
echo NL, file_get_contents( $詩文文檔路徑 );
?>