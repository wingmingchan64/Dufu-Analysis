<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成書本.php 蕭
*/
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '頁碼_路徑.php' );
require_once( 杜甫資料庫 . '頁碼_詩題.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );
require_once( 杜甫資料庫 . '二字組合_坐標.php' );
require_once( 杜甫資料庫 . '三字組合_坐標.php' );
require_once( 杜甫資料庫 . '四字組合_坐標.php' );
require_once( 杜甫資料庫 . '五字組合_坐標.php' );
require_once( 杜甫資料庫 . '詩組_詩題.php' );
require_once( 杜甫資料庫 . '詩句_坐標.php' );
require_once( 杜甫資料庫 . '帶序文之詩歌.php' );
require_once( 杜甫資料庫 . '詩行_行碼.php' );

if( sizeof( $argv ) < 2 )
{
	echo "必須提供簡稱。", "\n";
	exit;
}
$前綴 = trim( $argv[ 1 ] );
$簡稱 = 等號 . $前綴;
/*
$簡稱   = '=譯';
$簡稱   = '=地';
$簡稱   = '=今';
$簡稱   = '=浦';
$簡稱   = '=粵';
$簡稱   = '=全';
$簡稱   = '=蕭';
*/

$文件夾 = $書目簡稱[ $簡稱 ];
$out_path   = 杜甫資料庫 . "${文件夾}\\";
$注音_詩句 = array();
$詩句_注音 = array();
$詩題_注音 = array();
$count = 0;

//$頁 = "4361";
foreach( $頁碼 as $頁 )
{
	//if( $前綴 == '粵' && intval( $頁 ) > 20 )
	//{ exit; }
	
	require_once( 詩集文件夾 . $頁 . 程式後綴 );
	$默認内容 = $内容;
	require_once( 詩集文件夾 . "${頁}坐標_用字.php" );
	// get the relevant section as an array
	$text_array = getSection( $頁碼_路徑[ $頁 ], $簡稱 );
	//echo $頁, "\n";

	// nothing to process
	if( mb_strpos( implode( $text_array ), '【' ) === false )
	{
		//echo $頁, NL;
		continue;
	}
	
	// 書名: always the first line
	$書名  = trim( $text_array[ 0 ] );
	$部分陣列  = array();
	$current = "";
	$校記内容 = '';

	//print_r( $text_array );

	// skip 書名, empty line
	for( $i = 2; $i < sizeof( $text_array ); $i++ )
	{
		$行 = trim( $text_array[ $i ] );
	
		if( mb_strpos( $行, '【' ) !== false )
		{
			// functional headers like 【異文、夾注】,【注釋】
			$current = trim( $行 ); 
			//echo $current, NL;
			$部分陣列[ $current ] = array();
		}
		// skip empty line
		elseif( $行 == "" )
		{
			continue;
		}
		else
		{
			//echo $頁, NL;
			//echo $current, NL;
			//echo trim( $行 ), NL;
			try
			{
				array_push( $部分陣列[ $current ], trim( $行 ) );
			}
			
			catch( TypeError $e )
			{
				//echo '頁: ' , $頁, "\n";
				//echo $e;
				if( $簡稱 == '=浦' )
				{
					//continue;
				}
				echo $e;
			}
			
			//print_r( $部分陣列 );
		}
	}
	//print_r( $部分陣列 );exit;
	// used in variable name like $蕭内容
	$前綴 = trim( $簡稱, '=' );
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成書本.php $前綴
說明：${書目簡稱[ $簡稱 ]}中關於《${頁碼_詩題[$頁]}》的資料。
*/
\$${前綴}内容=array(\n" .
	"\"書名\"=>\"$書名\",\n";

	//$行音陣列 = array();
	//$平仄陣列 = array();
	//print_r( $部分陣列 );
	foreach( $部分陣列 as $k => $子儲存 )
	{
		$題 = mb_substr( $k, 1, -1 ); // remove 【】
		$補充説明  = ( $題 == 補充説明 );
		$異文、夾注 = ( $題 == 異文、夾注 );
		$校記     = ( $題 == 校記 );
		$評論     = ( $題 == 評論 );
		$體裁 = "";
		$附錄     = ( $題 == 附錄 );
		$旁注     = ( $題 == 旁注 );
		//echo "L117", NL;

		if( $題 == 體裁 )
		{
			$體裁 = $子儲存[ 0 ];
		}
		
		try
		{
			$内容 = implode( "\n", $子儲存 ); // a string
		}
		catch( TypeError $e )
		{
			echo $e;
		}
		$parts = array();
		//print_r( $内容 );
		
		// 粵音: 【注音】,【韻部】
		// 岱宗夫如何？齊魯青未了。
		// doi6 zung1 fu4 jyu4 ho4, cai4 lou5 cing1 mei6 liu5
		// ---------------------------------------------
		if( mb_strpos( $内容, '--' ) !== false )//delimiter
		{
			//echo "L138", NL;
			$音_陣列 = explode( "\n", $内容  ); // lines
			//print_r( $音_陣列 );
			$sub_code = "array(\n";
			$詩文注音 = '';
			$詩題文 = ''; // for comparison
			
			for( $i = 0; $i < sizeof( $音_陣列 ); $i++ )
			{
				$音  = "";
				$文  = "";
				$詩文注音 .= $音_陣列[ $i ] . "\n";
				// skip 詩題
				//echo $頁碼_詩題[ $頁 ], NL;
				//echo $音_陣列[ $i ], NL;
				if( mb_strpos( 
					$頁碼_詩題[ $頁 ], $音_陣列[ $i ] ) !== false )
				{
					$詩題文 = $音_陣列[ $i ];
					//$行音陣列[ '〖1〗' ] = $音_陣列[ $i ];
					//echo "inside\n";
					$詩題_注音[ $頁碼_詩題[ $頁 ] ] = $音_陣列[ $i+1 ];
					$詩文注音 .= $音_陣列[ $i+1 ] . NL . NL;
					$i = $i + 1;
					continue;
				}
				// skip -----------
				elseif( str_starts_with( 
					$音_陣列[ $i ], '--'  ) )
				{
					continue;
				}
				// , used only in the pronunciation
				elseif( mb_detect_encoding( 
					trim( $音_陣列[ $i ], 數字 ), ASCII ) == ASCII )
				//elseif( preg_match( '|\d|', $音_陣列[ $i ] ) )
				{
					// 詩文 preceding pronunciation
					//echo $音_陣列[ $i ], NL;
					// skip 序文
					if( $頁 == '3428' )
					{
						//echo $音_陣列[ $i-1 ], NL;
					}
					if( ( in_array( 序言, array_keys( $默認内容 ) ) ) &&
						$音_陣列[ $i-1 ] == $默認内容[ 序言 ] )
					{
						//echo $音_陣列[ $i-1 ], NL;
						continue;
					}
					$文 = normalize( $音_陣列[ $i-1 ] );
					$詩題文 .= $文;
					$parts[ $文 ] = array( $音_陣列[ $i ] );
					
					$音s = explode( ',', $音_陣列[ $i ] );
					$句s = explode( '。', $文 );
					
					if( $頁 == '4361' )
					{
						//print_r( $音s );
						//print_r( $句s );
						//exit;
					}
				
					$sub_code = $sub_code .
						"\n\"${文}\"=>array(\"${音_陣列[ $i ]}\",";
					
					// containing 平仄
					if( $i + 1 < sizeof( $音_陣列 ) &&
						( mb_strpos( $音_陣列[ $i+1 ], "平" ) !== false ) &&
						( mb_strpos( $音_陣列[ $i+1 ], "仄" ) !== false ) )
					{
						$sub_code = $sub_code . "\"${音_陣列[ $i+1 ]}\"),";
					}
					else
					{
						$sub_code = substr( $sub_code, 0, -1 );
						$sub_code = $sub_code . "),";
					}
					
					$音 = trim( $音s[ 0 ] );
					$注音_詩句[ $音 ] = $句s[ 0 ];
					$詩句_注音[ $句s[ 0 ] ] = $音;
					$count++;
					$sub_code = $sub_code .
						"\n\"${句s[ 0 ]}\"=>\"${音}\",";
					//print_r( $句s );
					if( sizeof( $音s ) > 1 )
					{
						foreach( range( 0, sizeof( $音s ) - 1 ) as $pos )
						{
							$音 = trim( $音s[ $pos ] );
						
							if( $音 != '' )
							{
								try{
								$sub_code = $sub_code .
									"\n\"${句s[ $pos ]}\"=>\"${音}\",";
								$注音_詩句[ $音 ] = $句s[ $pos ];
								$詩句_注音[ $句s[ $pos ] ] = $音;
								/*
								if( $頁 == "3428" )
								{
									echo $音, NL;
									echo $句s[ $pos ], NL;
								}
								*/
								$count++;
								} catch( Exception $e )
								{ echo $頁, NL; }
							}
						}
					}
				}
			}
			//$sub_code = $sub_code . "\"$文\"=>\"$音\",";
			//$sub_code = substr( $sub_code, 0, -2 );
			//$sub_code = $sub_code . "\n\"詩文注音\"=>\"$詩文注音\",";
			$sub_code = $sub_code . "),\n";
			$内容 = $sub_code;
			$内容 = $内容 . "\n\"詩文注音\"=>\"$詩文注音\",\n";
			$字音 = array(); // store 字 and its 音
			
			//echo $詩題文;
			/* 
			$result = compareText( $默認内容[ 詩題 ] . $默認内容[ 詩文 ],
				$詩題文, true );
			
			if( sizeof( $result ) == 0 )
			{
				continue;
			}
			else
			{
				echo $頁, NL;
				print_r( $result );
				exit;
			}
			 */
							
			foreach( $parts as $行 => $行音 )
			{
				$行 = str_replace( "。", "", $行 );
				//echo $行, NL;
				$行音 = str_replace( ',', '', $行音[ 0 ] );
				//echo $行音, NL;
				//$行音陣列 = explode( ' ', $行音[ 0 ] );
				$行音陣列 = explode( ' ', $行音 );
				//print_r( $行音陣列 );
			
				//echo $行, NL;
				//echo mb_strlen( $行 ), NL;
			
				//for( $i = 0; $i < trim( mb_strlen( $行 ), 數字 ); $i++ )
				for( $i = 0; $i < mb_strlen( $行 ); $i++ )
				{
					if( !array_key_exists( mb_substr( $行, $i, 1 ), $字音 ) )
					{
						$字音[ mb_substr( $行, $i, 1 ) ] = array();
					}
					
					//echo $頁, NL;
					//echo $i, ' ', $行音陣列[ $i ], NL;
					//echo sizeof( $行音陣列 ), NL;
					
					if( !in_array( 
						$行音陣列[ $i ],
						$字音[ mb_substr( $行, $i, 1 ) ] ) )
					{
						if( $行音陣列[ $i ] != "" )
						{
						array_push( 
							$字音[ mb_substr( $行, $i, 1 ) ], 
							$行音陣列[ $i ] );
						}
					}
				}
			}
		
			$subcode = "\"字音\"=>array(\n";
			
			foreach( $字音 as $字 => $音s )
			{
				$subcode = $subcode . "\"${字}\"=>array(";
			
				foreach( $音s as $音 )
				{
					if( strpos( $音, '/' ) )
					{
						$多音 = explode( '/', $音 );
					
						foreach( $多音 as $單音 )
						{
							$subcode = $subcode . "\"${單音}\",";
						}
					}
					else
					{
						$subcode = $subcode . "\"${音}\",";
					}
				}
				$subcode = substr( $subcode, 0, -1 );
				$subcode = $subcode . "),\n";
			}
			//$subcode = substr( $subcode, 0, -1 );
			$subcode = $subcode . "\n)";
			$内容 = $内容 . $subcode;
		} // end of 粵注音
		// 補充説明
		elseif( $補充説明 ) // a mixture of contents; just output it
		{
			//echo "L314", NL;
			$内容 = "\"$内容\"";
		}
		// 異文、夾注
		elseif( $異文、夾注 )
		{
			//echo "L320 $題", NL;
			$題 = "版本";
			$版本陣列 = 提取版本詩文( $簡稱, $頁 );
			$版本序言 = "";
		
			if( in_array( $頁, $帶序文之詩歌[ "頁碼" ] ) )
			{
				foreach( $版本陣列[ "坐標版本異文、夾注" ] as $item )
				{
if( $頁 == '3955' )
{
	//echo "L284 $item", NL;
}
					if( str_starts_with( $item, '〖3〗' ) )
					{
						$版本序言 = trim( normalize( mb_substr( 
							$item, mb_strlen( '〖3〗' ) ) ) );
						$内容 = $内容 . $版本序言 . "\n";
						break;
					}
				}
				//echo $版本序言, "\n";
			}
		
		//if( $頁 == "3955" )
			//print_r( $版本陣列 );
		
			$内容 = "array(";
		
			if( array_key_exists( "詩題", $版本陣列 ) )
			{
				$内容 = $内容 . "\n\"詩題\"=>\"" . $版本陣列[ "詩題" ] . "\",";
			}
		
			if( $版本序言 != "" )
			{
				$内容 = $内容 . "\n\"序言\"=>\"" . $版本序言 . "\",";
			}
		
			// 詩文
			if( array_key_exists( "詩文", $版本陣列 ) )
			{
				if( !is_array( $版本陣列[ "詩文" ] ) )
				{
					// ]* is a marker to instruct
					// the program to remove 。 after ]
					$詩文 = str_replace( 
						']*。', ']', $版本陣列[ "詩文" ] );
					$内容 = $内容 . "\n\"詩文\"=>\"" . 
						$詩文 . "\",";
					if( $簡稱 == '=全' && $頁 == "1607" )
					{
						$内容 = str_replace( "者。爲寄小如拳", "者。童稚捧應癲", $内容 );
					//echo $内容, "\n";
					}
				}
				else
				{
					$内容 = $内容 . "\n\"詩文\"=>array(";
				
					foreach( $版本陣列[ "詩文" ] as $詩文 )
					{
						//var_dump( $詩文 );
						$詩文 = str_replace( 
							']*。', ']', $詩文 );
						$内容 = $内容 . "\"${詩文}\",";
					}
					// swap the two poems
				if( $頁 == '3747' )
				{
					$内容 = str_replace(
						'"閬風玄圃與蓬壺。中有高堂[一作唐]天下無。借問夔州壓何處。峽門江腹擁城隅。","武侯祠堂[一作生祠]不可忘。中有松柏參天長。干戈滿地客愁破。雲日如火炎天涼。"',
						'"武侯祠堂[一作生祠]不可忘。中有松柏參天長。干戈滿地客愁破。雲日如火炎天涼。","閬風玄圃與蓬壺。中有高堂[一作唐]天下無。借問夔州壓何處。峽門江腹擁城隅。"',
						$内容
					);
				}

					$内容 = $内容 . "),\n";
				}
			}
		
			$内容 = $内容 . "\n\"坐標版本異文、夾注\"=>array(\n";
		
			foreach( $版本陣列[ "坐標版本異文、夾注" ] as 
				$坐標 => $版本異文、夾注 )
			{
				$内容 = $内容 . "\"${坐標}\"=>\"${版本異文、夾注}\",\n";
			}
			$内容 = $内容 . "),\n";
		
			$内容 = $内容 . ")";
		} // 
		//elseif( $評論 )
		//{}
		elseif( $校記 )
		{
			//echo "L414 $題", NL;
			//echo "Inside 校記: ", NL;
			//echo $内容, NL;
			//$校記内容 .= $内容;
			$内容 = "\"$内容\"";
		
		}
		elseif( $附錄 )
		{
			continue;
		}
		elseif( $旁注 )
		{
			//echo $内容, NL;
			if(	mb_strpos( $内容, '〖' ) !== false )
			{
				$〖儲存 = explode( '〖', $内容 );
				$sub_code = "array(\n";
				
				foreach( $〖儲存 as $l )
				{
					$l = trim( $l );
				
					if( $l == "" )
					{
						continue;
					}
					$parts = explode( '〗', $l );
					$行 = $parts[ 0 ];
					//$默認内容[ 行碼 ]
					//echo $行, NL;
					//print_r( $默認内容[ 行碼 ] );
					$行碼 = array_flip( $默認内容[ 行碼 ] )[ $行 ];
					//echo $行碼, NL;
					//echo $parts[ 1 ], NL;
					$注 = $parts[ 1 ];
					$l = "\"${行碼}\"=>\"${注}\",\n";
			
					$sub_code = $sub_code . $l;
				}
				$sub_code = substr( $sub_code, 0, -2 );
				$sub_code = $sub_code . ")\n";
				$内容 = $sub_code;
			}
			//continue;
		}
		// 坐標的轉換靠的是統一化詩文，因此出現在〖〗内的必須是
		// 我的統一化後的詩文。
		// 注釋
		elseif( mb_strpos( $内容, '〖' ) !== false ) 
		{
			$sub_code = "array(\n";
			//echo "L425", NL;
			$〖儲存 = explode( '〖', $内容 );
				
			foreach( $〖儲存 as $l )
			{
				// 含坐標
				$含坐標 = false;
				
				if( mb_strpos( $l, '〚' ) !== false )
				{
					$含坐標 = true;
					//$〚儲存 = explode( '〛', $内容 );
					//$詞條坐標 = $〚儲存[ 0 ] . '〛';
					//$注釋 = $〚儲存[ 1 ];
					//$l = "\"${詞條坐標}\"=>\"${注釋}\",\n";
					//$sub_code = $sub_code . $l;
				}

				$l = trim( $l );
			
				if( $l == "" )
				{
					continue;
				}
				if( $含坐標 )
				{
					$〚儲存 = explode( '〚', $l );
					$l = trim( $〚儲存[ 0 ] );
				}
				
				$parts = explode( '〗', $l );
				// 計算坐標

				$詞條 = $parts[ 0 ];
				$詞條長度 = mb_strlen( $詞條 );
				$詞條坐標 = "";
				$補字碼 = ".1-${詞條長度}";
/*
			if( $詞條 == 1 ) //〖1〗題解
			{
				$詞條坐標 = "〚${頁}:1〛";
				$注釋 = $parts[ 1 ];
			}
*/
				if( intval( $詞條 ) > 0 )
				{
					//echo $頁, "\n";
					$詞條坐標 = "〚${頁}:${詞條}〛";
					$注釋 = $parts[ 1 ];
				}
				elseif( $詞條長度 == 1 ) // 單字
				{
					foreach( $坐標_用字 as $坐標 => $用字 )
					{
						if( $詞條 == $用字 )
						{
							$詞條坐標 = $坐標;
							break;
						}
					}
					$注釋 = $parts[ 0 ] . '：' . $parts[ 1 ];
				}
				elseif( mb_strpos( $詞條, '〚' ) !== false )
				{
					$詞條坐標 = $詞條;
					$注釋 = $parts[ 1 ];
				}
				else  // 組合
				{				
					if( $詞條長度 == 2 )
					{
						$坐標s = $二字組合_坐標[ $詞條 ];
					}
					elseif( $詞條長度 == 3 )
					{
						$坐標s = $三字組合_坐標[ $詞條 ];
					}
					elseif( $詞條長度 == 4 )
					{
						$坐標s = $四字組合_坐標[ $詞條 ];
					}
					elseif( $詞條長度 == 5 )
					{
						//try{
						$坐標s = $五字組合_坐標[ $詞條 ];
						//} catch ( Exception $e ) { echo $頁; }
					}
					// $詞條長度 6 or above
					elseif( $詞條 != "" )
					{
						
						if( array_key_exists( $詞條, $詩句_坐標 ) )
						{
							$坐標s = array( $詩句_坐標[ $詞條 ] );
						}
						elseif( array_key_exists( $詞條, $詩行_行碼 ) )
						{
							$坐標s = array( $詩行_行碼[ $詞條 ] );
						}
						
					}
					// look for the first matching 坐標
					try{
					foreach( $坐標s as $坐標 )
					{
						if( str_starts_with( $坐標, '〚' . $頁 ) )
						{
							$詞條坐標 = $坐標;
							
							if( $詞條長度 > 5 )
							{
								$詞條坐標 = str_replace( '〛', "${補字碼}〛",
									$詞條坐標 );
							}
							break;
						}
					}
					} catch( Exception $e )
					{ echo $頁, NL; }
					
					try{
					$注釋 = $parts[ 0 ] . '：' . $parts[ 1 ];
					} catch( Exception $e )
					{ echo $頁, NL; }
				}
				$l = "\"${詞條坐標}\"=>\"${注釋}\",\n";
				$sub_code = $sub_code . $l;
				$nextline = '';
				if( $含坐標 )
				{
					$nextline = trim( $〚儲存[ 1 ] );
					$〛儲存 = explode( '〛', $nextline );
					$nextline = "\"〚" . $〛儲存[ 0 ] . "〛\"=>\"" . $〛儲存[ 1 ] . "\",\n";
					$sub_code = $sub_code . $nextline;
				}
			}
			$sub_code = substr( $sub_code, 0, -2 );
			$sub_code = $sub_code . ")\n";
			$内容 = $sub_code;
		}
		elseif( mb_strpos( $内容, '〚' ) !== false )
		{
			if( $頁碼 == '4361' )
			{
				echo 'here', NL;
			}
			$〚儲存 = explode( '〚', $内容 );
			$sub_code = "array(\n";
			
			foreach( $〚儲存 as $l )
			{
				$l = trim( $l );
				
				if( $l == "" )
				{
					continue;
				}

				//echo $頁, "\n";
				//$l = '〚' . $l ; // add 〚 back
				$parts = explode( '〛', $l );
				//print_r( $parts );
				
				if( sizeof( $parts ) > 1 )
				{
					$l = "\"〚" . $頁 . ':' . $parts[ 0 ] . "〛\"=>\"" .
					$parts[ 1 ] . "\",\n";
					$sub_code = $sub_code . $l;
				}
			}
			$sub_code = substr( $sub_code, 0, -2 );
			$sub_code = $sub_code . ")\n";
			$内容 = $sub_code;
		}
		elseif( $體裁 != "" )
		{
			$内容 = "\"$内容\"";
		}
		else
		{
			$内容 = "\"$内容\"";
		}
	
		$code = $code . "\"$題\"=>\n$内容,\n";
	}
	$code = $code . "\n);\n?>";
/*
	if( $簡稱 == "=全" )
	{
		// 刪除四句
		$code = str_replace(
			"再扈祠壇墠。前後百卷文。枕藉皆禁臠。篆刻揚雄流。", "", $code );
	}
*/	
	//echo $code;
	//echo $out_path . "$頁.php", "\n";
	file_put_contents( $out_path . "$頁.php", $code );
}

if( sizeof( $注音_詩句 ) > 1 )
{
	ksort( $注音_詩句 );
	$code1 = "<?php
\$注音_詩句=array(\n";
	$code2 = "<?php
\$詩句_注音=array(\n";

	foreach( $注音_詩句 as $注音 => $詩句 )
	{
		$code1 = $code1 . "\"${注音}\"=>\"${詩句}\",\n";
		$code2 = $code2 . "\"${詩句}\"=>\"${注音}\",\n";
	}
	$code1 = $code1 . ");\n?>";
	$code2 = $code2 . ");\n?>";
	file_put_contents( $out_path . "注音_詩句.php", $code1 );
	file_put_contents( $out_path . "詩句_注音.php", $code2 );
}
	
//echo sizeof( $注音_詩句 ), " ", $count, "\n";
$code = "<?php
\$詩題_注音=array(\n";

foreach( $詩題_注音 as $詩題 => $注音 )
{
	$code = $code . "\"$詩題\"=>\"$注音\",\n";
}
$code = $code . ");\n?>";
file_put_contents( $out_path . "詩題_注音.php", $code );
?>