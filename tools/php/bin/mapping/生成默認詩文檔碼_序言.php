<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩文檔碼_序言.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼_序言 = array();
$帶序言之詩 = 提取數據結構( 帶序言之詩 );

foreach( $帶序言之詩 as $頁 )
{
	$默認詩文檔碼_序言[ $頁 ] = $行碼_詩文[ $頁 ][ "〚${頁}:3〛" ];
}
//print_r( $默認詩文檔碼_序文 );

$json = json_encode(
	$默認詩文檔碼_序文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_序言.json",
	$json . PHP_EOL );

?>