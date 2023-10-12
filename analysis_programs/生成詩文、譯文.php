<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成詩文、譯文.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );
//require_once( 詩組_詩題 );
require_once( 杜甫詩全譯 . "韓成武、張志民《杜甫詩全譯》譯文.php" );

$output = '';
$stop_page = 300;

foreach( $頁碼 as $頁 )
{
	if( intval( $頁 ) > $stop_page )
	{
		//break;
	}
	require_once( 詩集文件夾 . $頁 . 程式後綴 );
	
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
			
			if( array_key_exists( $頁, $詩組_詩題 ) )
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
				$坐 = 生成完整坐標( $碼, $頁 );
			}
			if( array_key_exists( $坐, $韓成武、張志民《杜甫詩全譯》譯文 ) )
			{
				$output .= $韓成武、張志民《杜甫詩全譯》譯文[ $坐 ] . NL . NL;
			}
		}
	}
}
file_put_contents( 杜甫詩全譯 . '韓成武、張志民《杜甫詩全譯》詩文、譯文.txt', $output );
file_put_contents( "H:\\github\\Dufu-Analysis\\韓成武、張志民《杜甫詩全譯》\\韓成武、張志民《杜甫詩全譯》詩文、譯文.txt", $output );
?>