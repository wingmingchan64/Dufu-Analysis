<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\四聲輪用頁碼.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\頁碼.php" );
require_once( "h:\\github\\Dufu-Analysis\\詩組_詩題.php" );
require_once( "h:\\github\\Dufu-Analysis\\帶序文之詩歌.php" );


require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\杜甫詩陣列.php" );

/*
require_once( 平水韻文件夾 . '韻部_平仄' . 程式後綴 );
0003
0013


*/
$result = array();

//$頁碼 = array( '0003', '0013' );

foreach( $頁碼 as $頁 )
{
	//$路徑 = 詩集文件夾 . $頁 . 程式後綴;
	$注音路徑 = 杜甫全集粵音注音文件夾 . $頁 . 程式後綴;
	
	if( file_exists($注音路徑) )
	{
		//require_once( $路徑 );
		require_once( $注音路徑 );
		
		// 詩組
		if( array_key_exists( $頁, $詩組_詩題 ) )
		{
			if( !array_key_exists( 體裁, $粵内容 ) )
			{
				continue;
			}

			foreach( $粵内容[ 體裁 ] as $頁首 => $體裁 )
			{
				if( mb_strpos( $體裁, '律' ) === false )
				{
					continue;
				}
				else
				{
					$首 = str_replace( '〚', '', 
							str_replace( '〛', '',
								str_replace( 
									':', '', 
									str_replace( $頁, '', $頁首 ) ) ) );
					if( check四聲輪用( $杜甫詩陣列[ $頁 ][ $首 ] ) )
					{
						echo 頁, ' ', $首, NL;
					}
				}
			}
		}
		else
		{
			if( !array_key_exists( 體裁, $粵内容 ) )
			{
				continue;
			}
			if( mb_strpos( $粵内容[ 體裁 ], '律' ) === false )
			{
				continue;
			}
			else
			{
				if( check四聲輪用( $杜甫詩陣列[ $頁 ] ) )
					{
						echo 頁, NL;
					}
			}
		}
		
	}
	else
	{
		continue;
	}
	
}

function check四聲輪用( array $詩 ) : bool
{
	$韻字 = array( 
		'平' => false, 
		'上' => false, 
		'去' => false, 
		'入' => false ); 
	
	$keys = array_keys( $詩 );
	
	foreach( $keys as $k )
	{
		if( is_int( $k ) )
		{
			$values = $詩[ $k ][ '1' ];
			$末字 = $values[ '' . sizeof( $values ) ];
			echo $末字, NL;
		}
	}
	
	return false;
}

?>