<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成完整坐標.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );

$完整坐標 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	$完整坐標 = array_unique( array_merge( 
		$完整坐標, $默認詩文檔碼_完整坐標表[ $文檔碼 ]
	) );
}

sort( $完整坐標 );

$json = json_encode(
	$完整坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"完整坐標表.json",
	$json . PHP_EOL );

?>