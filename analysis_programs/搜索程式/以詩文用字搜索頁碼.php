<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字搜索頁碼.php 反覆
=>
Array
(
    [鄴中事反覆] => 1340
    [萬事反覆何所無] => Array
        (
            [0] => 1989
            [1] => 1989
        )

    [反覆乃須臾] => 3141
    [鄴城反覆不足怪] => 3236
    [反覆歸聖朝] => 3955
    [到今事反覆] => 4659
    [人生反覆看亦醜] => 5297
    [古來事反覆] => 5612
    [乾坤幾反覆] => 5855
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩句_頁碼 );

checkARGV( $argv, 2, 提供詩文 );
$句 = trim( $argv[ 1 ] );
$result = array();

foreach( $詩句_頁碼 as $詩句 => $頁碼 )
{
	if( mb_strpos( $詩句, $句 ) !== false )
	{
		$result[ $詩句 ] = $頁碼;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
print_r( $result );
?>