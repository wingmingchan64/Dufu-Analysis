<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、詩文單字→〚坐標〛.php 0668 妻
=> 坐標：〚43.1.2〛
注意：這種坐標不帶頁碼。
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

check_argv( $argv, 3, 提供頁、字 );
$頁碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$用字 = fix_text( trim( $argv[ 2 ] ) );

$path = 詩集文件夾 . $頁碼 . '坐標_用字.php';
//$found = false;
$result = array();

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
			//echo 坐標, '：', str_replace( "${頁碼}:", '', $坐 );
			//$found = true;
			array_push( $result, str_replace( "${頁碼}:", '', $坐 ) );
			//break;
		}
	}
	$size = sizeof( $result );
	if( $size == 0 )
	{
		echo 無結果, NL;
	}
	elseif( $size == 1 )
	{
		echo $result[ 0 ], NL;
	}
	else
	{
		print_r( $result );
	}
}
?>

