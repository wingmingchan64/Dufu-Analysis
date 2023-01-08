<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\搜索與坐標.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\詩句_坐標.php" );

$詩句 = "蹭蹬無縱鱗";
// 找出坐標
$詩句坐標 = $詩句_坐標[ $詩句 ];
// 裸坐標
$裸坐標 = trim( $詩句坐標, '〚〛' );
// 頁碼
$頁碼 = explode( ':', $裸坐標 )[ 0 ];
// 提取文檔
require_once( "h:\\github\\Dufu-Analysis\\張志烈主編《杜詩全集（今注本）》\\${頁碼}.php" );
foreach( $内容[ "注釋" ] as $坐標 => $注釋 )
{
	if( str_starts_with( $坐標, '〚' . $裸坐標 ) )
	{
		echo $注釋, "\n";
	}
}
/*
蹭蹬：受挫折。
縱鱗：魚縱身浮游（指得意）。
*/
?>
