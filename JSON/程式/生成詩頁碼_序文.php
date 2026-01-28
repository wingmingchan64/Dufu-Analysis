<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成詩頁碼_序文.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$頁碼 = array( "3686", "3955", "4546", "4556", "4813", "5308", "5941" );

$詩頁碼_序文 = array();

foreach( $頁碼 as $頁 )
{
	$詩頁碼_序文[ $頁 ] = $行碼_詩文[ $頁 ][ "〚${頁}:3〛" ];
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