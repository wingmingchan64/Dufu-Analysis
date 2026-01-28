<?php
/*
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
*/
declare( strict_types = 1 );

require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"常數.php" );
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"函式.php" );
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"loader.php" );
$JSON_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .	
	"數據結構";
$DATA = new JsonDataLoader( $JSON_BASE );
$詩頁碼 = $DATA->get( "詩頁碼" );
$詩頁碼_詩題 = $DATA->get( "詩頁碼_詩題" );
$詩頁碼_序文 = $DATA->get( "詩頁碼_序文" );
$詩頁碼_題注 = $DATA->get( "詩頁碼_題注" );
$詩組_詩題 = $DATA->get( "詩組_詩題" );
$行碼_副題 = $DATA->get( "行碼_副題" );
$行碼_詩文 = $DATA->get( "行碼_詩文" );
$句碼_詩句 = $DATA->get( "句碼_詩句" );
$杜甫詩陣列 = $DATA->get( "杜甫詩陣列" );
?>
