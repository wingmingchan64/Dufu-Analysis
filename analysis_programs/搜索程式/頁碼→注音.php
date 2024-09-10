<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→注音.php 0003
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫全集粵音注音文件夾 . "詩句_注音.php" );
require_once( 詩組_詩題 );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = fixPageNum( trim( $argv[ 1 ] ) );
$output = '';
$路徑    = 詩集文件夾 . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	
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
			// 注音
			$句s = explode( '。', $行 );
			
			foreach( $句s as $句 )
			{
				if( $句 != '' )
				{
					$output .= $詩句_注音[ $句 ] . ', ';
				}
			}
			$output = mb_substr( $output, 0, -2 );
			$output .= NL;
		}
	}
}
else
{
	echo 無結果, NL;
}
echo $output, NL;
?>