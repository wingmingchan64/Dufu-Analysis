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
require_once( 程式文件夾 . "函式.php" );
require_once( 
	杜甫分析文件夾 .
	"JSON" . DS . "程式" . DS . "loader.php" );
$JSON_BASE = 
	杜甫分析文件夾 . "JSON" . DS . "數據結構";
$DATA = new JsonDataLoader( $JSON_BASE );
$默認詩文檔碼 = $DATA->get( 默認詩文檔碼 );
$默認詩文檔碼_詩題 = $DATA->get( 默認詩文檔碼_詩題 );
$默認詩文檔碼_題注 = $DATA->get( 默認詩文檔碼_題注 );
$默認詩文檔碼_序文 = $DATA->get( 默認詩文檔碼_序文 );
$組詩_副題 = $DATA->get( 組詩_副題 );
$帶序文之詩 = $DATA->get( 帶序文之詩 );
$行碼_詩文 = $DATA->get( 行碼_詩文 );
$行碼_副題 = $DATA->get( "行碼_副題" );
$句碼_詩句 = $DATA->get( "句碼_詩句" );
$杜甫詩陣列 = $DATA->get( "杜甫詩陣列" );

//蕭滌非
$蕭JSON_BASE = 
	杜甫分析文件夾 . "JSON" . DS . "蕭滌非《杜甫全集校注》";
$蕭DATA = new JsonDataLoader( $蕭JSON_BASE );
$默詩碼_蕭詩碼 = $蕭DATA->get( 默詩碼_蕭詩碼 );
$蕭詩碼_默詩碼 = $蕭DATA->get( 蕭詩碼_默詩碼 );
$詩題_蕭詩碼 = $蕭DATA->get( 詩題_蕭詩碼 );
$蕭詩碼_詩題 = $蕭DATA->get( 蕭詩碼_詩題 );

?>
