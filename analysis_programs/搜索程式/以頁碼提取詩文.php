<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼提取詩文.php 0013
=> 詩文：春山無伴獨相求。伐木丁丁山更幽。澗道餘寒歷冰雪。石門斜日到林丘。不貪夜識金銀氣。遠害朝看麋鹿遊。乘興杳然迷出處。對君疑是泛虛舟。之子時相見。邀人晚興留。霽潭鱣發發。春草鹿呦呦。杜酒偏勞勸。張梨不外求。前村山路險。歸醉每無愁。
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供頁碼。", "\n";
	exit;
}

$頁碼 = trim( $argv[ 1 ] );

$path = 詩集文件夾 . $頁碼 . 程式後綴;

if( file_exists( $path ) )
{
	require_once( $path );
	echo 詩文, '：', $内容[ 詩文 ], "\n";
}
else
{
	echo "沒有結果。\n";
}
?>