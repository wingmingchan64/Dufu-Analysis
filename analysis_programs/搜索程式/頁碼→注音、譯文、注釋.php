<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→注音、譯文、注釋.php 0943
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = trim( $argv[ 1 ] );
$output = '';

$路徑    = 詩集文件夾    . $頁碼 . 程式後綴;
//$注音路徑 = 杜甫全集粵音注音文件夾 . $頁碼 . 程式後綴;
//$譯文路徑 = 杜甫詩全譯    . $頁碼 . 程式後綴;
//$注釋路徑 = 杜詩全集今注本 . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	//require_once( $注音路徑 );
	//require_once( $譯文路徑 );
	//require_once( $注釋路徑 );
	
	/*
	foreach( $内容[ 行碼 ] as $碼 => $行 )
	{
		if( $碼 == '〚1〛' )
		{
			$output .= $行 . NL . NL;
		}
		elseif( $行 == '' )
		{
			continue;
		}
		else
		{
			$output .= $行 . NL;
			$行 = mb_substr( $行, 0, -1 );
			$output .= $粵内容[ 注音 ][ $行 ][ 0 ] . NL;
		}
	}
	*/
}
else
{
	echo 無結果, NL;
}
echo $output, NL;
?>