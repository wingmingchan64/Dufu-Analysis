<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\函式文檔測試\是合法錨値Test.php
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

try
{
	顯示布爾値( 是合法錨値( '〚0003:5.1.1-3〛' ) );
	顯示布爾値( 是合法錨値( '〚5.1.1-3〛' ) );
	顯示布爾値( 是合法錨値( '〚0003:5.1.8〛' ) );
}
catch( InvalidAnchorValueException $e )
{
	echo $e, NL;
}
try
{
	顯示布爾値( 是合法錨値( '古人' ) );
}
catch( InvalidAnchorValueException $e )
{
	echo $e, NL;
}
顯示布爾値( 是合法錨値( '現代' ) );
?>

