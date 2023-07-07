<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、詩文單字🡒〚坐標〛.php 0668 妻
=> 坐標：〚43.1.2〛
注意：這種坐標不帶頁碼。
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 3, 提供頁、字 );
$頁碼 = trim( $argv[ 1 ] );
$用字 = trim( $argv[ 2 ] );

$path = 詩集文件夾 . $頁碼 . '坐標_用字.php';
$found = false;

if( !file_exists( $path ) )
{
	echo 無頁碼, NL;
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
		echo 無結果, NL;
	}
}
?>

