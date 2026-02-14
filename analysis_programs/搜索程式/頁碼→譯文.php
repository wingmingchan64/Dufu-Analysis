<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→譯文.php 0003
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫詩全譯 . "韓成武、張志民《杜甫詩全譯》譯文.php" );
require_once( 詩組_詩題 );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = fix_doc_id( trim( $argv[ 1 ] ) );
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
			
			// 譯文
			// 詩組，有首碼
			$坐 = '';
			
			if( array_key_exists( $頁碼, $詩組_詩題 ) )
			{
				foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
				{
					if( mb_strpos( $行, $句 )!== false )
					{
						$坐 = str_replace( '.1', '', $坐標 );
						break;
					}
				}
			}
			else
			{
				$坐 = 生成完整坐標( $碼, $頁碼 );
			}
			$output .= $韓成武、張志民《杜甫詩全譯》譯文[ $坐 ] . NL . NL;
		}
	}
}
else
{
	echo 無結果, NL;
}
echo $output, NL;
?>