<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→〚坐標〛、韻字.php 0943
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_韻部 );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = trim( $argv[ 1 ] );
$韻 = '';
$output = '';

$路徑    = 詩集文件夾 . $頁碼 . 程式後綴;
$注音路徑 = 杜甫全集粵音注音文件夾 . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );

	if( file_exists( $注音路徑 ) )
	{
		require_once( $注音路徑 );
		
		if( array_key_exists( 韻部, $粵内容 ) )
		{
			$output .= $内容[ 詩題 ] . NL;
			$output .= 【韻部】 . NL;

			foreach( $粵内容[ 韻部 ] as $坐 => $韻 )
			{
				$output .= $坐 . $韻 . NL;
			}
		}
	}

	if( $output == '' )
	{
		foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
		{
			$坐標 = str_replace( '〚', '', str_replace( '〛', '', $坐標 ) );
			$坐標 = str_replace( ':', '-', str_replace( '.', '-', $坐標 ) );
			$坐標parts = explode( '-', $坐標 );
			$字數 = mb_strlen( $句 );
			
			$末字 = mb_substr( $句, $字數 - 1, 1 );
			
			foreach( $字_韻部[ $末字 ] as $韻部 )
			{
				$韻部 = mb_substr( $韻部, mb_strlen( $韻部 ) - 1, 1 );
				$韻 .= $韻部;
			}

			if( sizeof( $坐標parts ) == 3 && $坐標parts[ 2 ] == '2' )
			{
				$output .= "〚" . $坐標parts[ 1 ] . '.' . 
					$坐標parts[ 2 ] . '.' . $字數 . "〛" .
					$末字 . '：' . $韻 . '韻' . NL; 
			}
			elseif( sizeof( $坐標parts ) == 4 && $坐標parts[ 3 ] == '2' )
			{
				$output .= "〚" . $坐標parts[ 1 ] . ':' . 
					$坐標parts[ 2 ] . '.' .
						$坐標parts[ 3 ] . '.' . $字數 . "〛" .
					mb_substr( $句, $字數 - 1, 1 ) . '：' . $韻 . '韻' . NL; 
			}
			$韻 = '';
		}
	}
	$output .= "
【體裁】
五律
五古
五排
七律
七古
七排
";
	echo $output;
}
else
{
	echo 無結果, NL;
}
?>