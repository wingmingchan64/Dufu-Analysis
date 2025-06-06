<?php
/*
php H:\github\Dufu-Analysis\test\create版本書本.php 136 郭
php H:\github\Dufu-Analysis\test\create版本書本.php 3 浦
php H:\github\Dufu-Analysis\test\create版本書本.php 3789 錢

*/
require_once( "H:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
require_once( 頁碼 );
require_once( 杜甫詩陣列 );

checkARGV( $argv, 3, 提供頁、簡 );
$result = array();
$頁 = fixPageNum( trim( $argv[ 1 ] ) );
if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}
$簡稱 = fixText( trim( $argv[ 2 ] ) );
if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$陣列名 = "${簡稱}内容";
$目錄名 = "${簡稱}目錄";
//require_once( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 );
$content = '';


// 目錄 used to direct the program
$text      = getFile( 杜甫資料庫 . $書名 . "\\${目錄名}.txt" );
$lines     = explode( "\n", $text );
$store     = array();
$contents  = '';
$file_name = 'H:\github\Dufu-Analysis\test\版本.txt';
$start_page = '3789';//$頁; 
$end_page   = '3789';
$in = false;

foreach( $lines as $l )
{
	$l = trim( $l );
	// when an empty line is encounter, skip it
	if( $l == '' )
	{
		continue;
	}
	// the 卷 line is the file name
	elseif( mb_strpos( $l, '//' ) === false && 
		mb_strpos( $l, '卷' ) !== false )
	{
		continue;
	}
	else // only lines with //
	{
		$l       = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		if( sizeof( $l_array ) < 2 )
		{
			continue;
		}
		$默認頁碼  = trim( $l_array[ 1 ] );
		
		// deal with this later
		if( !$in && $默認頁碼 != $start_page )
		{
			continue;
		}
		elseif( !$in && $默認頁碼 == $start_page )
		{
			$in = true;
			// read 詩 array 
			$詩陣列 = $杜甫詩陣列[ $默認頁碼 ];
			// 提取版本資料
			$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $默認頁碼 . 程式後綴;
			//try
			//{
			if( file_exists( $版本路徑 ) )
			{
				$版本注釋 = array(); // array
				
				// 準備各個部分
				require_once( $版本路徑 );
				
				// 詩題
				if( array_key_exists( 版本, $$陣列名 ) &&
					array_key_exists( 詩題, $$陣列名[ 版本 ] ) )
				{
					$版本詩題 = $$陣列名[ 版本 ][ 詩題 ];
				}
				else
				{
					$版本詩題 = $詩陣列[ 詩題 ];
				}
				$詩陣列[ 詩題 ] = $版本詩題;
				
				$是詩組 = array_key_exists( $默認頁碼, $詩組_詩題 );
				
				if( $是詩組 )
				{
					$首數 = sizeof( $詩組_詩題[ $默認頁碼 ][ 1 ] );
					//sizeof( $詩陣列 ) - 1; // 詩題是其中之一
				}
				
				$帶序文 = in_array( $默認頁碼, $帶序文之詩歌[ '頁碼' ] );

				// 【注釋】
				if( array_key_exists( 注釋, $$陣列名 ) )
				{
					$版本注釋 = $$陣列名[ 注釋 ]; // array
				}
				// 【題解】:坐標第一行
				$題解 = '';
				$坐標 = "〚${默認頁碼}:1〛";
				
				if( array_key_exists( $坐標, $版本注釋 ) )
				{
					$詩陣列[ 詩題 ] = $詩陣列[ 詩題 ] . '[' . $版本注釋[ $坐標 ] . ']' . NL;
				}
				
				if( array_key_exists( 版本, $$陣列名 ) &&
					array_key_exists( 坐標版本異文、夾注, $$陣列名[ 版本 ] ) )
				{
					$版本異文、夾注 = $$陣列名[ 版本 ][ 坐標版本異文、夾注 ];
					
					foreach( $版本異文、夾注 as $key => $value )
					{
						replaceText( $詩陣列, $key, $value );
					}
				}
								
				foreach( $版本注釋 as $key => $value )
				{
					insertText( $詩陣列, $key, 
						$value . ']', false ); // [ added later
				}
				
				if( array_key_exists( 詩題, $詩陣列 ) )
				{
					$contents = $詩陣列[ 詩題 ] . $contents;
				}
				
				if( array_key_exists( 按語, $$陣列名 ) )
				{
					//$contents .= NL . NL . 【校記】 . NL . $$陣列名[ 校記 ] ;
					//$詩陣列[ 按語 ] . $$陣列名[ 按語 ];
				}
				if( array_key_exists( 校記, $$陣列名 ) )
				{
					//$contents .= NL . NL . 【校記】 . NL . $$陣列名[ 校記 ] ;
					//$詩陣列[ 按語 ] . $$陣列名[ 按語 ];
				}
				

			}
		}
		
		if( $in && $默認頁碼 == $end_page )
		{
			$in = false;
			$contents .= getMergedText( $詩陣列 );
			
			if( array_key_exists( 評論, $$陣列名 )  )
			{
				if( is_string( $$陣列名[ 評論 ] ) )
				{
					$contents .= NL . NL . 【評論】 . NL . $$陣列名[ 評論 ];
				}
				elseif( is_array( $$陣列名[ 評論 ] ) )
				{
					$contents .= NL . NL . 【評論】 . NL;
					foreach( $$陣列名[ 評論 ] as $comment )
					{
						$contents .= $comment . NL;
					}
				}
			}
			break;
		}
	}
}

$contents .= NL . 分隔線 . NL;
echo $contents, NL;
//print_r( $詩陣列 );

function replaceText( array &$詩陣列, string $坐標, string $文字 )
{
	//echo $坐標, $文字, NL;
	// prepare $坐標
	$坐標陣列 = getCoordArray( $坐標 );
	$size = sizeof( $坐標陣列 );
	$字碼 = $坐標陣列[ $size - 1 ];
	$句碼 = $坐標陣列[ $size - 2 ];
	try
	{
		$行碼 = $坐標陣列[ $size - 3 ];
		$首碼 = $坐標陣列[ $size - 4 ]; // possibly $首碼 = $頁碼
	}
	catch( ErrorException $e )
	{
	}
	//echo '行碼 ', $行碼, NL;
	//echo '句碼 ', $句碼, NL;
	//echo '字碼 ', $字碼, NL;
	
	// prepare $文字
	if( mb_strpos( $文字, '〗' ) !== false )
	{
		$文字 = mb_substr( $文字, mb_strpos( $文字, '〗' ) + 1 );
	}
	$in = false;
	$len = mb_strlen( $文字 );
	$temp = array();
	//echo '文字 ', $文字, NL;
	
	for( $i = 0; $i < $len; $i++ )
	{
		$char = mb_substr( $文字, $i, 1 );
		
		if( $char != '[' && $char != ']' && !$in )
		{
			//echo $char, NL;
			array_push( $temp, $char );
		}
		elseif( $char == '[' )
		{
			$in = true;
			if( sizeof( $temp ) > 0 )
			{
				$temp[ sizeof( $temp ) - 1 ] = 
					$temp[ sizeof( $temp ) - 1 ] . $char;
			}
		}
		elseif( $char == ']' )
		{
			$in = false;
			if( sizeof( $temp ) > 0 )
			{
				$temp[ sizeof( $temp ) - 1 ] = 
					$temp[ sizeof( $temp ) - 1 ] . $char;
			}
		}
		else
		{
			if( sizeof( $temp ) > 0 )
			{
				$temp[ sizeof( $temp ) - 1 ] = 
					$temp[ sizeof( $temp ) - 1 ] . $char;
			}
		}
	}
	//print_r( $temp );
	if( $size == 5 )
	{
		//echo '首碼 ' . $首碼 . NL;
		//echo '行碼 ' . $行碼 . NL;
		//echo '句碼 ' . $句碼 . NL;
		//print_r( $詩陣列[ $首碼 ][ $行碼 ][ $句碼 ] );
		$字數 = sizeof( $詩陣列[ $首碼 ][ $行碼 ][ $句碼 ] );
		for( $i = 0; $i<$字數; $i++ )
		{
			$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $i+1 ] = $temp[ $i ];
		}
	}
	elseif( $size == 4 )
	{
		$字數 = sizeof( $詩陣列[ $行碼 ][ $句碼 ] );
		//for( $i = 0; $i<$字數; $i++ )
		for( $i = 0; $i<$字數&&$i<sizeof($temp); $i++ )
		{
			//echo '行碼 ' . $行碼 . NL;
			//echo '句碼 ' . $句碼 . NL;
			//echo $i, NL;
			
			//print_r( $temp );
			
			$詩陣列[ $行碼 ][ $句碼 ][ $i+1 ] = $temp[ $i ];
		}
	}
	//print_r( $詩陣列 );
}

function clearUp( string $str ) : string
{
	return str_replace( '[', '',
			str_replace( ']', '',
				normalize( $str, true, true, true ) ) );
}

?>