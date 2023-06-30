<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集_版本.php 蕭xu

$簡稱 = '=蕭';
$簡稱 = '=默';
$簡稱 = '=全';
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );

if( sizeof( $argv ) < 2 )
{
	echo "必須提供簡稱。", "\n";
	exit;
}

$前綴 = trim( $argv[ 1 ] );
$簡稱 = '=' . $前綴;
$默認路徑 = 詩集文件夾;
$默認文檔路徑 = "";

if( $簡稱 != '=默' )
{
	$陣列名 = "${前綴}内容";
	$書名 = $書目簡稱[ $簡稱 ];
	$outfile = 杜甫資料庫 . "${書名}\\杜甫全集.txt";
	$outfile_clean = 杜甫資料庫 . "${書名}\\杜甫全集無夾注.txt";
	$new_content = $書名 . "\n\n";
	$版本路徑 = 杜甫資料庫 . "${書名}\\";
}
else
{
	$new_content = "";
	$outfile = 杜甫資料庫 . "杜甫全集.txt";
	$outfile_clean = 杜甫資料庫 . "杜甫全集無夾注.txt";
}

// 全唐詩
if( $簡稱 == '=全' )
{
	require_once( 杜甫資料庫 . "${書名}\目錄.php" );
	$頁碼 = array_keys( $全目錄 );
	$temp_storage = array();
}

foreach( $頁碼 as $頁 )
{
	// 全唐詩
	if( $頁 == "哭長孫侍御" ||
		$頁 == "九日登梓州城" ||
		$頁 == "闕題" ||
		$頁 == "句" 
	)
	{
		$path = 全唐詩 . "${頁}.php";
		if( file_exists( $path ) )
		{
			require_once( $path );
			$new_content = $new_content . $全内容[ 版本 ][ 詩題 ] . "\n\n";
			$new_content = $new_content . $全内容[ 版本 ][ 詩文 ] . "\n\n";
		}
		continue;
	}

	// a hidden char
	$頁 = str_replace( '﻿', '', $頁 );
	//echo $頁, "\n";
	if( $頁 == "" )
	{
		continue;
	}
	if( $簡稱 == '=蕭' && $頁 == '1989' ) // 蕭缺此詩
	{
		continue;
	}
	
	//echo $頁, "\n";
	$首 = 0;
	$裸坐標 = "";
	
	if( mb_strpos( $頁, ":" ) )
	{
		$裸坐標 = $頁;
		$碼s = explode( ":", $頁 );
		$頁 = trim( $碼s[ 0 ] );
		$首 = intval( trim( $碼s[ 1 ], ":" ) );
		
		//if( $頁 == "2516" )
			//echo $頁, "\n";
		//echo $首, "\n";
		//continue;
	}
	$默認文檔路徑 = $默認路徑 . $頁 . ".php";
	require_once( $默認文檔路徑 );
	
	// 默認版本以外的其他版本
	if( $簡稱 != '=默' )
	{
		$版本文檔路徑 = $版本路徑 . $頁 . '.php';
	
		if( file_exists( $版本文檔路徑 ) )
		{
			require_once( $版本文檔路徑 );

			//echo $頁, "\n";
//if( $頁 == "3466" )
//{
	//break;
//}
			// 詩題
			if( array_key_exists( "詩題", $$陣列名[ "版本" ] ) )
			{
				//echo $$陣列名[ "版本" ][ "詩題" ], "\n";
//if( $頁 == "2516" )
	//echo "2516\n";
				if( $頁 != "2530" || $裸坐標 == "2530:2:" )
				{
					$new_content = $new_content . $頁 . ' ' .
						trim( $$陣列名[ "版本" ][ "詩題" ] ) . "\n\n";
				}
			}
			else
			{				
				if( $簡稱 == '=全' &&
					$裸坐標 != "" )
				{
					if( $全目錄[ $裸坐標 ][ 0 ] != "" && $頁 != "0062" )
					{
//if( $頁 == "2516" )
	//echo "2516 else\n";
						$new_content = $new_content .
							$全目錄[ $裸坐標 ][ 0 ] .
							"\n";
						//if( $裸坐標 == "2516:2:" )
							//$new_content = $new_content . "\n";
					/*
						if( $裸坐標 == "2530:1:" )
						{
							$new_content = $new_content . "\n";
						}
					*/
					}
					
					if( $頁 == "0062" )
					{
						if( $首 == 1 )
						{
							$new_content = $new_content . "0062 " .
								str_replace( '〖1:1〗', '', $$陣列名[ "版本" ][ "坐標版本異文、夾注" ]
									[ '〚0062:1:1〛' ] ) . "\n\n" .
								$$陣列名[ "版本" ][ "詩文" ][ 0 ] . "\n\n";
							$temp_storage[ '〚0062:2:〛' ] = "0062 " .
								str_replace( '〖2:1〗', '', $$陣列名[ "版本" ][ "坐標版本異文、夾注" ]
									[ '〚0062:2:1〛' ] ) . "\n\n" .
								$$陣列名[ "版本" ][ "詩文" ][ 1 ] . "\n\n";
						}
						elseif( $首 == 2 )
						{
							$new_content = $new_content . $temp_storage[ '〚0062:2:〛' ] . "\n";
						}
						continue;
					}
				}
				else
				{
					if( $頁 == "1395" || 
					    $頁 == "0241" )
					{
						$new_content = $new_content .
							"\n";
					}
										
					$new_content = $new_content . $頁 . ' ' . trim( $内容[ "詩題" ] );
					
					if( in_array( "題注", array_keys( $内容 ) ) )
					{
						$new_content = $new_content .
							'[' . $内容[ "題注" ] . ']';
					}
					$new_content = $new_content . "\n\n";
				}
			}
			if( in_array( "序言", array_keys( $$陣列名[ "版本" ] ) ) )
			{
				//echo $$陣列名[ "版本" ][ "序言" ], "\n";
				$new_content = $new_content . $$陣列名[ "版本" ][ "序言" ] . "\n";
			}
			if( $簡稱 == '=全' && $頁 == '5855' )
			{
				$序 = $$陣列名[ "版本" ][ "坐標版本異文、夾注" ]
					[ "〚5855:3〛" ];
				//echo $序, "\n";
				$序 = str_replace( '〖3〗', '', $序 );
				$new_content = $new_content . $序 . "\n";
			}
			
			if( $頁 == "3955" )
			{
				$八哀詩副題 = array();
				for( $i = 1; $i < 9; $i++)
				{
					array_push( $八哀詩副題,
						substr(
							$$陣列名[ "版本" ][ "坐標版本異文、夾注" ]
								[ "〚$頁:$i:〛" ], 8 ) );
				}
				//print_r( $八哀詩副題 );
				
			}
			/*
			if( $頁 == "4813" )
			{
				$new_content = $new_content . 
					str_replace( "，", "。", 
						str_replace( "、", "。", $内容[ "序言" ] ) ) .
					"\n";
			}
			*/
			
			// 詩文
			// 詩組,
			if( is_array( $$陣列名[ "版本" ][ "詩文" ] ) )
			{
				//echo $首, "\n";
				if( $首 != 0 )
				{
					//echo $首, "\n";
					if( $頁 != "2516" )
					{
						$new_content = $new_content .
							$$陣列名[ "版本" ][ "詩文" ][ $首 - 1 ];
					}
					// ad hoc code just to make it work
					if( $頁 == "1376" )
					{
						$temp_storage[ "1376:3:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 2 ];
						$temp_storage[ "1376:4:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 3 ];
						$temp_storage[ "1376:5:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 4 ];
					}
					
					if( $頁 == "2516" )
					{
						if( $首 == 2 )
						{
							$new_content = $new_content . "\n" .
							$$陣列名[ "版本" ][ "詩文" ][ 1 ] . "\n";
							
						$temp_storage[ "2516:1:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 0 ];
						$temp_storage[ "2516:3:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 2 ];
						$temp_storage[ "2516:4:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 3 ];
						$temp_storage[ "2516:5:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 4 ] . "\n";
						}
						else
						{
							//echo $裸坐標, "\n";
							$new_content = $new_content .
								$temp_storage[ $裸坐標 ] ;
						}
					}
										
					if( $頁 == "1390" && $首 == 2 )
					{
						$new_content = $new_content .
						"\n" .
						$temp_storage[ "1376:3:" ] . "\n" .
						$temp_storage[ "1376:4:" ] . "\n" .
						$temp_storage[ "1376:5:" ] . "\n";
					}
				}
				else
				{
					if( $頁 == "2516" )
					{
						//$全目錄[ "${頁}:1" ]
						 //print_r( $内容[ "副題" ] );
					}
					$cur_index = 1;
					
					$八_index = 0;
					
					foreach( $$陣列名[ "版本" ][ "詩文" ] as $詩 )
					{
						/*
						if( $頁 == "2516" )
						{
							
							echo $詩, "\n";
							if( $cur_index == 2 )
								continue;
							
							$new_content = $new_content .
							$全目錄[ "〚2516:${cur_index}:〛" ][ 1 ] . "\n" . $temp_storage[ "〚2516:${cur_index}:〛" ];
							
							$cur_index++;
						}
						*/
						if( $頁 == "3955" )
						{
							$new_content = $new_content .
								$八哀詩副題[ $八_index ] . "\n";
							$八_index++;
						}
						$new_content = $new_content .
							trim( $詩 ) . "\n";
					}
					if( $頁 == "2591" )
					{
						$new_content = preg_replace( '/元年建巳月。\[是月代宗改元。復以建巳月爲四月。]官有王司直/', '元年建巳月。官有王司直', $new_content );
					}
				}
				$new_content = $new_content . "\n";
				
			}
			else
			{
				$new_content = $new_content .
					trim( $$陣列名[ "版本" ][ "詩文" ] ) . "\n\n";			
			}
		}
		elseif( $簡稱 == '=蕭' )
		{
			//echo $頁 . "\n";
			
			$new_content = $new_content . $頁 . ' ' .
				trim( $内容[ "詩題" ] );
			if( in_array( "題注", array_keys( $内容 ) ) )
			{
				$new_content = $new_content .
					'[' . $内容[ "題注" ] . ']';
			}
			$new_content = $new_content . "\n\n";
			$new_content = $new_content . 
				$内容[ "詩文" ] . "\n\n";
		}
	}
	// 默認版本
	else
	{
		$new_content = $new_content . $頁 . ' ' .
			trim( $内容[ "詩題" ] );
			
		if( in_array( "題注", array_keys( $内容 ) ) )
		{
			$new_content = $new_content .
				'[' . $内容[ "題注" ] . ']';
		}
		
		$new_content = $new_content . "\n\n";
		
		if( array_key_exists( "詩歌", $内容 ) )
		{
			$副題_詩句 = $内容[ "詩歌" ];
			
			foreach( $副題_詩句 as $副題 => $詩句 )
			{
				$詩文 = normalize( implode( $詩句 ) );
				$new_content = $new_content . $詩文 . "\n";
			}
			
			$new_content = $new_content . "\n";
		}
		else
		{
			$new_content = $new_content . 
				$内容[ "詩文" ] . "\n\n";
		}
	}
}

$全唐詩異體字 = array( // see line 400
	'溼'=>'濕',
	'衆'=>'眾',
	'荊'=>'荆',
	'内'=>'內',
	'跡'=>'迹',
	
);
// add msg and write to files
if( $簡稱 != '=默' && file_exists( $版本路徑 . '說明.txt' ) )
{
	$說明 = file_get_contents( $版本路徑 . '說明.txt', true );;
}
else
{
	$說明 = '';
}

$msg = str_replace( '﻿', '', file_get_contents( 'msg.txt', true ) );

if( $簡稱 != '=默' )
{
	if( $簡稱 == "=全" )
	{
		// 刪除四句
		$new_content = str_replace(
			"再扈祠壇墠。前後百卷文。枕藉皆禁臠。篆刻揚雄流。", "", $new_content );
		$new_content = str_replace( "++", "", $new_content );
		// 刪除重複詩文夾注
		$new_content = str_replace(
		'江花未落還成都。江花未落還成都。[一本無此疊句。一作還成都多暇。]江花未落還成都。江花未落還成都。[一本無此疊句。一作還成都多暇。]', '江花未落還成都。江花未落還成都。[一本無此疊句。一作還成都多暇。]', $new_content );
		
		$new_content = str_replace(
		'[時代宗幸陝。詔徵天下兵。無一人應召者。故感激言之。]嗚呼。', '嗚呼。', $new_content );
		
		
		foreach( $全唐詩異體字 as $異體字 => $標準字 )
		{
			//$new_content = str_replace( $異體字, $標準字, $new_content );
		}
		
		
	}

	file_put_contents( $outfile, $說明 . $new_content . $msg );
	file_put_contents( "h:\\github\\Dufu-Analysis\\" . $書目簡稱[ $簡稱 ] . "\\杜甫全集.txt", $new_content . $msg );
}
// 默認
else
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\杜甫全集.txt", $說明 . $new_content . $msg );
}

$cleaned_text = 
	preg_replace( '/\[\X+?]/', '', $new_content );
file_put_contents( $outfile_clean, $說明 . $cleaned_text . $msg );
if( $簡稱 != '=默' )
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\" . $書目簡稱[ $簡稱 ] . "\\杜甫全集無夾注.txt", $說明 . $cleaned_text . $msg );
}
else
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\杜甫全集無夾注.txt", $說明 . $cleaned_text . $msg );
}
?>