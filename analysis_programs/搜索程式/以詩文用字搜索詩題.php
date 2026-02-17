<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字搜索詩題.php 反覆
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
    [乾坤幾反覆] => 5855 蘇大侍御渙，靜者也，旅于江側，凡是不交州府之客，人事都絕久矣。肩輿江浦，忽訪老夫舟楫，而已茶酒內，余請誦近詩，肯吟數首，才力素壯，詞句動人。接對明日，憶其湧思雷出，書篋几杖之外，殷殷留 金石聲，賦八韻記異，亦記老夫傾倒於蘇至矣
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩句_頁碼 );
require_once( 頁碼_詩題 );

check_argv( $argv, 2, 提供詩文 );
$句 = trim( $argv[ 1 ] );
$result = array();

foreach( $詩句_頁碼 as $詩句 => $頁碼 )
{
	if( mb_strpos( $詩句, $句 ) !== false )
	{
		if( is_string( $頁碼 ) )
		{
			$result[ $詩句 ] = $頁碼 . ' ' . $頁碼_詩題[ $頁碼 ];
		}
		elseif( is_array( $頁碼 ) )
		{
			foreach( $頁碼 as $頁 )
			{
				$result[ $詩句 ] = $頁 . ' ' . $頁碼_詩題[ $頁 ];
			}
			
		}
		//echo $頁碼_詩題[ $頁碼 ];
		///$result[ $詩句 ] = $頁碼_詩題[ $頁碼 ];
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>