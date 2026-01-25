<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成詩頁碼_序文.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
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
	"杜甫全集";
$JSON_詩BASE = 
	$JSON_BASE . DIRECTORY_SEPARATOR . "詩";
//$JSON_行碼_詩文BASE = 
	//$JSON_詩BASE . DIRECTORY_SEPARATOR . "行碼_詩文";
$DATA = new JsonDataLoader( $JSON_BASE );
$行碼_詩文 = $DATA->get( "行碼_詩文" );
//$詩組_詩題 = $DATA->get( "詩組_詩題" );
/*
$詩_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"杜甫全集" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;
*/
$頁碼 = array( "3686", "3955", "4546", "4556", "4813", "5308", "5941" );

$詩頁碼_序文 = array();

foreach( $頁碼 as $頁 )
{
	$詩頁碼_序文[ $頁 ] = $行碼_詩文[ "〚${頁}:3〛" ];
}
//print_r( $詩頁碼_序文 );
$json = json_encode(
	$詩頁碼_序文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"詩頁碼_序文.json",
	$json . PHP_EOL );

?>