<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字搜索詩句.php 妻子
=> 
Array
(
    [詩句] => Array
        (
            [0] => 耶娘妻子走相送
            [1] => 妻子隔絕久
            [2] => 妻子山中哭向天
            [3] => 妻子衣百結
            [4] => 結髮爲妻子
            [5] => 笑爲妻子累
            [6] => 歎息謂妻子
            [7] => 卻看妻子愁何在
            [8] => 妻子寄他食
            [9] => 食人更肯留妻子
            [10] => 汝去迎妻子
            [11] => 妻子亦何人
            [12] => 未能割妻子
            [13] => 汝迎妻子達荆州
        )

    [坐標] => Array
        (
            [0] => 〚0229:5.1〛
            [1] => 〚0841:3.2〛
            [2] => 〚0909:8.1〛
            [3] => 〚0943:32.2〛
            [4] => 〚1299:5.1〛
            [5] => 〚1642:48.1〛
            [6] => 〚1846:10.1〛
            [7] => 〚2747:4.1〛
            [8] => 〚3245:1:7.1〛
            [9] => 〚3466:1:6.2〛
            [10] => 〚4607:1:5.1〛
            [11] => 〚5180:16.1〛
            [12] => 〚5257:6.1〛
            [13] => 〚5347:1:5.1〛
        )
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\杜甫資料庫\\詩句_坐標.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩文用字。", "\n";
	exit;
}
$詩文用字 = trim( $argv[ 1 ] );
$result = array();
$result[ "詩句" ] = array();
$result[ "坐標" ] = array();

foreach( $詩句_坐標 as $詩句 => $坐標 )
{
	if( mb_strpos( $詩句, $詩文用字 ) !== false )
	{
		array_push( $result[ 詩句 ], $詩句 );
		array_push( $result[ 坐標 ], $坐標 );
	}
}
print_r( $result );
?>