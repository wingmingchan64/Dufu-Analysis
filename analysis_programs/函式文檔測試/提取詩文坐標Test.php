<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\函式文檔測試\提取詩文坐標Test.php
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


$r = 提取詩文坐標( '6090', '朔雲寒菊' );

print_r( $r );
?>

