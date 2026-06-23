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
$行碼_內容 = 提取數據結構( 默認詩文檔碼_行碼_內容 );

foreach( $帶序言之詩 as $頁 )
{
	$默認詩文檔碼_序言[ $頁 ] = $行碼_內容[ $頁 ][ "〚${頁}:3〛" ];
}
//print_r( $默認詩文檔碼_序文 );

$json = json_encode(
	$默認詩文檔碼_序言,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR .
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩文檔碼_序言.json",
	$json . PHP_EOL );

?>