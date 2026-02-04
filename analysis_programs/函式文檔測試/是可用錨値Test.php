<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\函式文檔測試\是可用錨値Test.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"函式.php" );


顯示布爾値( 是可用錨値( '0001', '人' ) ); // false
顯示布爾値( 是可用錨値( '0003', '人' ) ); //
顯示布爾値( 是可用錨値( '0013', '春' ) );
顯示布爾値( 是可用錨値( '0013', '春山' ) );
?>

