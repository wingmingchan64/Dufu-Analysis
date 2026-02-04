<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\函式文檔測試\是組詩Test.php
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

//print_r( 提取擴充字碼坐標( '〚0003:5.1.1-3〛' ) );

echo 是組詩( '〚0003:5.1.1-3〛' ), NL;
echo 是組詩( '0003' ), NL;
echo 是組詩( '0013' ), NL;
?>

