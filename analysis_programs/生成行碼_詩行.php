<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成行碼_詩行.php
*/
require_once( '常數.php' );
require_once( 頁碼 );
require_once( 詩句_坐標 );
//$page_path = ( "h:\\github\\Dufu-Analysis\\詩集\\" );
//詩集文件夾
$code1 = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成行碼_詩行.php
說明：行碼=>詩行。
*/
\$行碼_詩行=array(\n";

$code2 = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成行碼_詩行.php
說明：詩行=>行碼。
*/
\$詩行_行碼=array(\n";
	// 同一句可以出現在不同詩中
$行坐 = array();

foreach( $頁碼 as $p )
{
	require_once( 詩集文件夾 . $p . '.php' );
		
	foreach( $内容[ 行碼 ] as $碼 => $行 )
	{
		// containing 。
		if( mb_strpos( $行, '。' ) !== false )
		{
			$句s = explode( '。', $行 );
			$first  = $句s[ 0 ];
			$second = $句s[ 1 ];
			
			if( !array_key_exists( $first, $詩句_坐標 ) )
			{
				continue;
			}
			$first坐 = $詩句_坐標[ $first ];
			$second坐 = array_key_exists( $second, $詩句_坐標 ) ?
				$詩句_坐標[ $second ] : '';
			
			if( !is_array( $first坐 ) )
			{
				$詩行行碼 = str_replace( '.1', '', $first坐 );
				//echo $詩行行碼;
			}
			elseif( is_array( $first坐 ) && $second坐 != '' )
			{
				foreach( $first坐 as $坐 )
				{
					$詩行行碼 = str_replace( '.1', '', $坐 );
					
					
					if( is_string( $second坐 ) && mb_strpos( $second坐, $詩行行碼 ) !== false )
					{
						break;
					}
				}
				//echo $詩行行碼;
			}
			$行 = $first . '。';
			if( $second != '' )
			{
				$行 = $行 . $second . '。';
			}
			$code1 = $code1 . "'$詩行行碼'=>'$行',\n";
			$code2 = $code2 . "'$行'=>'$詩行行碼',\n";
		}
			
			
/*
			$code1 = $code1 . "\"${坐}\"=>\"${句}\",\n";
			if( !array_key_exists( $句, $句坐 ) )
			{
				$句坐[ $句 ] = $坐;
			}
			else
			{
				if( !is_array( $句坐[ $句 ] ) )
				{
					$句坐[ $句 ] = array( $句坐[ $句 ], $坐 );
				}
				else
				{
					array_push( $句坐[ $句 ], $坐 );
				}
			}
			//$code2 = $code2 . "\"${句}\"=>\"${坐}\",\n";
			*/
		}
	}
/*	
	foreach( $句坐 as $句 => $坐 )
	{
		if( !is_array( $坐 ) )
		{
			$code2 = $code2 . "\"${句}\"=>\"${坐}\",\n";
		}
		else
		{
			$code2 = $code2 . "\"${句}\"=>array(";
			foreach( $坐 as $coor )
			{
				$code2 = $code2 . "\"" . $coor . "\",";
			}
			$code2 = $code2 . "),\n";
		}
	}
*/
	// truncate last ,\n
	$code1 = substr( $code1, 0, -2 );
	$code2 = substr( $code2, 0, -2 );
	$code1 = $code1 . ");\n?>";
	$code2 = $code2 . ");\n?>";
	file_put_contents( 杜甫資料庫 . '行碼_詩行.php', $code1 );
	file_put_contents( 杜甫資料庫 . '詩行_行碼.php', $code2 );

?>