<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成默認詩文檔碼_序文.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認詩文檔碼_序文 = array();

foreach( $帶序文之詩 as $頁 )
{
	$默認詩文檔碼_序文[ $頁 ] = $行碼_詩文[ $頁 ][ "〚${頁}:3〛" ];
}
//print_r( $默認詩文檔碼_序文 );

$json = json_encode(
	$默認詩文檔碼_序文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_序文.json",
	$json . PHP_EOL );

?>