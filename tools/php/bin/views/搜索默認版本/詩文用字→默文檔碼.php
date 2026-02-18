<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩文用字→默文檔碼.php 反覆
=>
Array
(
    [鄴中事反覆] => 1340 遣興三首
    [萬事反覆何所無] => 1989 杜鵑行
    [反覆乃須臾] => 3141 草堂
    [鄴城反覆不足怪] => 3236 憶昔二首
    [反覆歸聖朝] => 3955 八哀詩
    [到今事反覆] => 4659 又上後園山腳
    [人生反覆看亦醜] => 5297 可歎
    [古來事反覆] => 5612 送顧八分文學適洪吉州
    [乾坤幾反覆] => 5855 蘇大侍御渙，靜者也，旅于江 側，凡是不交州府之客，人事都絕久矣。肩輿江浦，忽訪老夫舟楫，而已茶酒內，余請誦近詩，肯吟數首，才力素壯，詞句動人。接對明日，憶其湧思雷出，書篋几杖之外，殷殷留金石聲，賦八韻記異，亦記老夫傾倒於蘇至矣
)
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$result = array();
$temp = array();

$字數 = mb_strlen( $詩文 );
$文_碼 = 提取數據結構( 數字對照陣列[ $字數 ] );

if( array_key_exists( $詩文, $文_碼 ) )
{
	$result = $文_碼[ $詩文 ];
	//foreach( $temp 
}
else
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>