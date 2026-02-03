<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\test.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

require_once( "函式.php" );
print_r( 提取擴充字碼坐標( '〚0003:5.1.1-3〛' ) );
echo 是合法完整坐標( $默認詩文檔碼_完整坐標表, '〚0003:5.1.1-3〛' );
?>

