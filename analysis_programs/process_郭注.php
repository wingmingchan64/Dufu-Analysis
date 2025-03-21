<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_郭注.php
*/
//require_once( "常數.php" );
require_once( "函式.php" );
//require_once( 詩組_詩題 );
//require_once( 帶序文之詩歌 );
require_once( 杜甫詩陣列 );

// 目錄 used to direct the program
$text      = getFile( 'H:\github\Dufu-Analysis\郭知達《新刊校定集注杜詩》\郭目錄.txt' );
$lines     = explode( "\n", $text );
$store     = array();
$contents  = '';
$file_name = '';

foreach( $lines as $l )
{
	$l = trim( $l );
	// when an empty line is encounter, write content to a file
	if( $l == '' )
	{
		$outfile = 杜甫分析文件夾 . "郭知達《新刊校定集注杜詩》\\${file_name}.txt";
		file_put_contents( $outfile, $contents . 
			str_replace( '﻿', '', file_get_contents( 程式文件夾 . 'msg.txt' ) ) );
		continue;
	}
	// the 卷 line is the file name
	elseif( mb_strpos( $l, '//' ) === false && 
		mb_strpos( $l, '卷' ) !== false )
	{
		$file_name = $l;
		$contents = $l . NL . NL;
		continue;
	}
	else // only lines with //
	{
		$l       = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		$默認頁碼  = trim( $l_array[ 1 ] );
		
		// deal with this later
		if( $l_array[ 1 ] == '6497' )
		{
			continue;
		}
				
		// stop at a new 卷
		if( $默認頁碼 == '0111' )
		{ break; }
	
		// read 詩 array 
		$詩陣列 = $杜甫詩陣列[ $默認頁碼 ];
		
		// 詩題 from 異文、夾注〖1〗 or from $詩陣列
		// 加版本頁碼
		$版本詩題 = ' ' . $默認頁碼 . ' ' . $l_array[ 2 ] . NL; 
		// 提取版本資料
		$版本路徑 = 新刊校定集注杜詩 . $默認頁碼 . 程式後綴;

		try
		{
			if( file_exists( $版本路徑 ) )
			{
				$版本詩文 = '';
				$版本注釋 = array(); // array
				
				// 準備各個部分
				require_once( $版本路徑 );
				// 詩題
				if( array_key_exists( 詩題, $郭内容[ 版本 ] ) )
				{
					$詩題 = $郭内容[ 版本 ][ 詩題 ];
				}
				else
				{
					$詩題 = $詩陣列[ 詩題 ];
				}
				$版本詩題 = $詩題 . $版本詩題;
				
				$是詩組 = array_key_exists( $默認頁碼, $詩組_詩題 );
				if( $是詩組 )
				{
					$首數 = sizeof( $詩陣列 ) - 1; // 詩題是其中之一
					/*
					$副題 = array();
					foreach( $詩陣列 as $key => $value )
					{
						// 儲存詩組副題
						if( $key != 詩題 )
						{
							$副題[ $key ] = $詩陣列[ $key ][ 副題 ];
						}
					}
					*/
				}
				
				// 【序言】
				$帶序文 = in_array( $默認頁碼, $帶序文之詩歌[ '頁碼' ] );
				$序言 = '';
											
				// 詩組:每首各有大意
				// 分段:每段各有大意
				
				// 【注釋】
				$版本注釋 = array();
				if( array_key_exists( 注釋, $郭内容 ) )
				{
					$注釋 = $郭内容[ 注釋 ]; // array
				}
				// 【題解】:坐標第一行
				$題解 = '';
				$坐標 = "〚${默認頁碼}:1〛";
				
				if( array_key_exists( $坐標, $注釋 ) )
				{
					$題解 = $注釋[ $坐標 ] . NL;
					$題解 = 【題解】 . NL . $題解;
				}

				$counter = 1;
					
				foreach( $注釋 as $key => $value )
				{
					if( 提取行碼( $key ) == '1' ) // skip 題解
					{
						continue;
					}
					// 加注碼
					$版本注釋[ $key ] = "[${counter}]" . $value;
					$counter++;
				}
				$分段注釋 = array();
				//print_r( $版本注釋 );
					
				if( $是詩組 ) // 按詩分
				{
					$分段注釋 = 分割注釋( array_keys( $詩陣列 ), $版本注釋 );
				}
				
				$版本異文、夾注 = $郭内容[ 版本 ][ 坐標版本異文、夾注 ];
				
				if( !$是詩組 )
				{
					$版本詩文陣列 = 提取版本詩文含夾注陣列( 
						$詩陣列, $版本異文、夾注, $版本注釋, true, false );
						
					if( !$是分段 )
					{
						$版本詩文 = 【詩文】 . NL . 杜甫詩陣列首ToString( $版本詩文陣列 );
					}
					//echo $版本詩文, NL;
				}
				// 詩組
				else
				{
					$版本詩文列陣 = 提取版本詩文含夾注陣列( 
						$詩陣列, $版本異文、夾注, $版本注釋, true, false );
					$版本詩文 = '';
					$詩文列陣 = array();
					
					foreach( $版本詩文列陣 as $key => $子列陣 )
					{
						//print_r( $子列陣 );
						if( is_array( $子列陣 ) )
						{
							$版本詩文 .= $子列陣[ '副題' ] . NL . NL;
							$版本詩文 .= 提取杜甫詩陣列詩文(
								array( '1' =>$子列陣 ), true, false );
							$版本詩文 .= NL . NL;
							array_push( $詩文列陣, $版本詩文 );
							$版本詩文 = '';
						}
					}
				}
				
				// 【大意】
				$坐標 = "〚${默認頁碼}:〛";
				$大意 = '';
				// 
				if( is_array( $版本大意 ) && array_key_exists( $坐標, $版本大意 ) )
				{
					$大意 = $版本大意[ $坐標 ] . NL . NL;
					$大意 = 【大意】 . NL . $大意;
				}

				$counter = 1;
				$注釋陣列 = array();
				$注釋 = '';
								
				if( !$是詩組 )
				{
					foreach( $版本注釋 as $key => $value )
					{
						if( 提取行碼( $key ) == '1' )
						{
							continue;
						}
						$注釋 .= '[' . $counter . ']' .
							$value . NL;
						$counter++;
					}
				}
				else
				{
					foreach( $版本注釋 as $key => $value )
					{
						if( 提取行碼( $key ) == '1' )
						{
							continue;
						}
						$首碼 = 提取首碼( $key );
						
						if( !array_key_exists( $首碼, $注釋陣列 ) )
						{
							$注釋陣列[ $首碼 ] = array();
						}
						array_push( $注釋陣列[ $首碼 ], '[' . $counter . ']' . $value );
						$counter++;
					}
				}
				
			}
			
			// 組合各部分
			$contents .= $版本詩題 . NL;
			$contents .= $題解 . NL;
			
			if( $是詩組 )
			{
				$首數 = sizeof( $詩組_詩題[ $默認頁碼 ][ 1 ] );
				
				for( $i = 1; $i <= $首數; $i++ )
				{
					$contents .= 【詩文】 . NL;
					$contents .= $詩文列陣[ $i - 1 ];
					//echo "2", NL;
					$contents .= 【注釋】 . NL;
					$contents .= implode( NL, $分段注釋[ $i ] ) . NL . NL;
					
				}
			}

			// 大部分其他詩
			else
			{
				if( array_key_exists( '序言', $版本詩文陣列 ) )
				{
					$contents .= $版本詩文陣列[ '序言' ] . NL . NL;
				}
				$contents .= $版本詩文 . NL . NL;
				$contents .= $大意;
				$contents .= 【注釋】 . NL;
				foreach( $版本注釋 as $坐標 => $注釋 )
				{
					$contents .= $注釋 . NL;
				}
				
				if( array_key_exists( '評論', $郭内容 ) && 
					is_string( $郭内容[ '評論' ] ) )
				{	
					$contents .= NL . 【評論】 . NL;
					$contents .= $郭内容[ '評論' ] . NL;
				}
				$contents .= NL;
			}
			
			// 【附錄】
			
			// 【按語】
			if( array_key_exists( 按語, $郭内容 ) )
			{
				$contents .= NL . 【按語】 . NL;
				$contents .= $郭内容[ 按語 ] . NL . NL;
			}
			
			// 【校記】
			if( array_key_exists( 校記, $郭内容 ) )
			{
				$contents .= NL . 【校記】 . NL;
				$contents .= $郭内容[ 校記 ] . NL . NL;
			}

			$contents .= 分隔線 . NL;
		}
		catch( ErrorException $e )
		{
			echo $默認頁碼, NL;
			echo $e;
		}
		catch( TypeError $e )
		{
			echo $默認頁碼, NL;
			echo $e;
		}
	}
}
?>

