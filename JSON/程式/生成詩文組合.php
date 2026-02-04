<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成詩文組合.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$詩文組合 = array();

//foreach( 
$一 = 提取數據結構( 一字組合_坐標 );
$二 = 提取數據結構( 二字組合_坐標 );
$三 = 提取數據結構( 三字組合_坐標 );
$四 = 提取數據結構( 四字組合_坐標 );
$五 = 提取數據結構( 五字組合_坐標 );
$六 = 提取數據結構( 六字組合_坐標 );
$七 = 提取數據結構( 七字組合_坐標 );
$八 = 提取數據結構( 八字組合_坐標 );
$九 = 提取數據結構( 九字組合_坐標 );
$十 = 提取數據結構( 十字組合_坐標 );
$十一 = 提取數據結構( 十一字組合_坐標 );
$詩文組合 = array_unique(
	array_merge(
		array_keys( $一 ),
		array_keys( $二 ),
		array_keys( $三 ),
		array_keys( $四 ),
		array_keys( $五 ),
		array_keys( $六 ),
		array_keys( $七 ),
		array_keys( $八 ),
		array_keys( $九 ),
		array_keys( $十 ),
		array_keys( $十一 )
	) );
//print_r( $詩文組合 );


$json = json_encode(
    $詩文組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"數據結構" . DIRECTORY_SEPARATOR .
	"詩文組合.json",
	$json . PHP_EOL );
?>
