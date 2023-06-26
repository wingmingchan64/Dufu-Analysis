<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼詩文用字提取坐標.php 0668 妻
=> 坐標：〚43.1.2〛
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

if( sizeof( $argv ) != 3 )
{
	echo "必須提供頁碼、用字。", "\n";
	exit;
}
$頁碼 = trim( $argv[ 1 ] );
$用字 = trim( $argv[ 2 ] );

$path = 詩集文件夾 . $頁碼 . '坐標_用字.php';
$found = false;

if( !file_exists( $path ) )
{
	echo "頁碼不存在。\n";
}
else
{
	require_once( $path );
	
	foreach( $坐標_用字 as $坐 => $字 )
	{
		if( $用字 == $字 )
		{
			echo 坐標, '：', str_replace( "${頁碼}:", '', $坐 );
			$found = true;
			break;
		}
	}
	if( !$found )
	{
		echo "沒找著‘${用字}’字\n";
	}
}
?>

