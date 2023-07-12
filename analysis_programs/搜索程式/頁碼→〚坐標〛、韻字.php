<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→〚坐標〛、韻字.php 0943
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→〚坐標〛、韻字.php 0943 曷
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
//require_once( 頁碼_詩題 );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = trim( $argv[ 1 ] );
$韻 = '';

if( sizeof( $argv ) == 3 )
{
	$韻 = trim( $argv[ 2 ] );
}
	
$路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$output = '';

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	
	$output .= $内容[ 詩題 ] . NL;
	foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
	{
		$坐標 = str_replace( '〚', '', str_replace( '〛', '', $坐標 ) );
		$坐標 = str_replace( ':', '-', str_replace( '.', '-', $坐標 ) );
		$坐標parts = explode( '-', $坐標 );
		$字數 = mb_strlen( $句 );
		
		if( sizeof( $坐標parts ) == 3 && $坐標parts[ 2 ] == '2' )
		{
			$output .= "〚" . $坐標parts[ 1 ] . '.' . 
				$坐標parts[ 2 ] . '.' . $字數 . "〛" .
				mb_substr( $句, $字數 - 1, 1 ) . '：' . $韻 . '韻' . NL; 
		}
		elseif( sizeof( $坐標parts ) == 4 && $坐標parts[ 3 ] == '2' )
		{
			$output .= "〚" . $坐標parts[ 1 ] . ':' . 
				$坐標parts[ 2 ] . '.' .
					$坐標parts[ 3 ] . '.' . $字數 . "〛" .
				mb_substr( $句, $字數 - 1, 1 ) . '：' . $韻 . '韻' . NL; 
		}
	}
	
	echo $output;
}
else
{
	echo 無結果, NL;
}
?>