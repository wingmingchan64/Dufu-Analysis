<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫詩陣列.php
*/
require_once( '常數.php' );
require_once( "函式.php" );
require_once( 頁碼 );
require_once( 頁碼_詩題 );
require_once( 帶序文之詩歌 );
require_once( 詩組_詩題 );

//$頁碼 = array( '3955', /* '0013', '3955', '4556' */ );
$杜甫詩陣列 = array();

foreach( $頁碼 as $k => $頁 )
{
	require_once( 詩集文件夾 . $頁 . 程式後綴 );
	//echo $頁碼_詩題[ $頁 ], NL;
	$杜甫詩陣列[ $頁 ] = array();
	// 詩題
	$杜甫詩陣列[ $頁 ][ 詩題 ] = $頁碼_詩題[ $頁 ];
	if( array_key_exists( 題注, $内容 ) )
	{
		$杜甫詩陣列[ $頁 ][ 題注 ] = $内容[ 題注 ];
	}
	// 序言
	if( array_key_exists( 序言, $内容 ) )
	{
		$杜甫詩陣列[ $頁 ][ 序言 ] = $内容[ 序言 ];
	}
	// 詩組
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$詩組數目 = sizeof( $詩組_詩題[ $頁 ][ 1 ] );
		
		for( $i = 1; $i <= $詩組數目; $i++ )
		{
			$杜甫詩陣列[ $頁 ][ "$i" ] = array();
		}
		foreach( $内容[ 副題 ] as $坐標 => $副題 )
		{
			$路徑 = 坐標轉換成列陣路徑( $坐標 );
			$杜甫詩陣列[ $路徑[ 0 ] ][ $路徑[ 1 ] ] = array();
			$杜甫詩陣列[ $路徑[ 0 ] ][ $路徑[ 1 ] ][ 副題 ] = $副題;
		}
	}
	// 詩文
	foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
	{
		$路徑列陣 = 坐標轉換成列陣路徑( $坐標 );
		$句字數 = mb_strlen( $句 );
		
		// 有首碼
		if( sizeof( $路徑列陣 ) == 4 )
		{
			for( $i = 0; $i < $句字數; $i++ )
			{
				$字 = mb_substr( $句, $i, 1 );
				$杜甫詩陣列[ $路徑列陣[ 0 ] ]
					[ $路徑列陣[ 1 ] ]
					[ $路徑列陣[ 2 ] ]
					[ $路徑列陣[ 3 ] ]
					[ "" . $i + 1 ]= $字;
			}
		}
		elseif( sizeof( $路徑列陣 ) == 3 )
		{
			for( $i = 0; $i < $句字數; $i++ )
			{
				$字 = mb_substr( $句, $i, 1 );
				$杜甫詩陣列[ $路徑列陣[ 0 ] ]
					[ $路徑列陣[ 1 ] ]
					[ $路徑列陣[ 2 ] ]
					[ "" . $i + 1 ]= $字;
			}
		}
	}
}
//print_r( $杜甫詩陣列 );
$code = "<?php
/*
生成： 生成杜甫詩陣列.php
*/
\$杜甫詩陣列=array(
";
foreach( $杜甫詩陣列 as $頁 => $子列陣 )
{
	$code = $code . "\"${頁}\"=>array(" . NL;
	
	if( in_array( $頁, array_keys( $詩組_詩題 ) ) )
	{
		foreach( $子列陣 as $首碼 => $行子列陣 )
		{
			if( is_string( $行子列陣 ) )
			{
				$code = $code . 
					" \"${首碼}\"=>\"${行子列陣}\"," . NL;
				continue;
			}
			$code = $code . " \"${首碼}\"=>array(" . NL;
			//print_r( $行子列陣 );

			foreach( $行子列陣 as $行碼 => $句子列陣 )
			{
				if( is_string( $句子列陣 ) )
				{
					$code = $code . 
						"  \"${行碼}\"=>\"${句子列陣}\"," . NL;
					continue;
				}

				
				$code = $code . "   \"${行碼}\"=>array(" . NL;
				foreach( $句子列陣 as $句碼 => $字子列陣 )
				{
					$code = $code . "\"${句碼}\"=>array(";
					foreach( $字子列陣 as $字碼 => $字 )
					{
						$code = $code . "\"${字碼}\"=>\"${字}\",";
					}
					$code = $code . ")," . NL;
				}
				
				$code = $code . ")," . NL;
			}
			$code = $code . ")," . NL;
		}
	}
	else
	{
		foreach( $子列陣 as $行碼 => $句子列陣 )
		{
			if( is_string( $句子列陣 ) )
			{
				$code = $code . 
					" \"${行碼}\"=>\"${句子列陣}\"," . NL;
				continue;
			}

			$code = $code . " \"${行碼}\"=>array(" . NL;
			foreach( $句子列陣 as $句碼 => $字子列陣 )
			{
				if( is_string( $字子列陣 ) )
				{
					$code = $code . 
						"  \"${句碼}\"=>\"${字子列陣}\"," . NL;
					continue;
				}

				$code = $code . "   \"${句碼}\"=>array(";
				foreach( $字子列陣 as $字碼 => $字 )
				{
					$code = $code . "\"${字碼}\"=>\"${字}\",";
				}
				$code = $code . ")," . NL;
			}
				
			$code = $code . ")," . NL;
		}
	}
	$code = $code . ")," . NL;
}

$code = $code . ");
?>" . NL;
file_put_contents( 杜甫資料庫 . '杜甫詩陣列.php', $code );
file_put_contents( 程式文件夾 . '杜甫詩陣列.php', $code );

?>

