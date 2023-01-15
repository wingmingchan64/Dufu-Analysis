<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成書本.php
*/
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼_路徑.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼_詩題.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );
require_once( 'h:\github\Dufu-Analysis\二字組合_坐標.php' );
require_once( 'h:\github\Dufu-Analysis\三字組合_坐標.php' );
require_once( 'h:\github\Dufu-Analysis\四字組合_坐標.php' );
require_once( 'h:\github\Dufu-Analysis\詩組_詩題.php' );

$簡稱   = '=譯';
$簡稱   = '=地';
$簡稱   = '=全';
$簡稱   = '=今';
$簡稱   = '=蕭';

$文件夾 = $書目簡稱[ $簡稱 ];
$out_path   = "h:\\github\\Dufu-Analysis\\${文件夾}\\";
//$頁 = "0241";
foreach( $頁碼 as $頁 )
{
require_once( "h:\\github\\Dufu-Analysis\\詩集\\${頁}坐標_用字.php" );

//echo $頁, "\n";

	$text_array = getSection( $頁碼_路徑[ $頁 ], $簡稱 );
	if( mb_strpos( implode( $text_array ), '【' ) === false )
	{
		continue;
	}
	$書名  = trim( $text_array[ 0 ] );
	$部分陣列  = array();
	$current = "";

//print_r( $text_array );

// skip the first two line
for( $i = 2; $i < sizeof( $text_array ); $i++ )
{
	$行 = trim( $text_array[ $i ] );
	
	if( mb_strpos( $行, '【' ) !== false )
	{
		$current = trim( $行 );
		//echo $current, "\n";
		$部分陣列[ $current ] = array();
	}
	elseif( $行 == "" )
	{
		continue;
	}
	else
	{
		//echo $頁, "\n";
		//echo $current, "\n";
		//echo $行, "\n";
		array_push( $部分陣列[ $current ], trim( $行 ) );
	}
}
$前綴 = trim( $簡稱, '=' );
$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：${書目簡稱[ $簡稱 ]}中關於《${頁碼_詩題[$頁]}》的資料。
*/
\$${前綴}内容=array(\n" .
	"\"書名\"=>\"$書名\",\n";

foreach( $部分陣列 as $k => $子儲存 )
{
	$題 = trim( $k, '【】' );
	$補充説明 = ( $題 == '補充説明' );
	$異文、夾注 = ( $題 == '異文、夾注' );
	$内容 = implode( "\n", $子儲存 );
	$parts = array();

	// 粵音
	if( mb_strpos( $内容, '--' ) !== false )
	{
		$音_陣列 = explode( "\n", $内容  );
		
		$sub_code = "array(\n";

		for( $i = 0; $i < sizeof( $音_陣列 ); $i++ )
		{
			$音  = "";
			$文  = "";
			
			// skip 詩題
			if( mb_strpos( $頁碼_詩題[ $頁 ], $音_陣列[ $i ] )
				!== false )
			{
				$i = $i + 1;
				continue;
			}
			// skip -----------
			elseif( str_starts_with( $音_陣列[ $i ], '--'  ) )
			{
				continue;
			}
			elseif( strpos( $音_陣列[ $i ], ',' ) !== false )
			{
				$文 = normalize( $音_陣列[ $i-1 ] );
				$parts[ $文 ] = array( $音_陣列[ $i ] );
				
				$sub_code = $sub_code .
					"\n\"${文}\"=>array(\"${音_陣列[ $i ]}\",";
				
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
			}
			
		}
		//$sub_code = $sub_code . "\"$文\"=>\"$音\",";
		//$sub_code = substr( $sub_code, 0, -2 );
		$sub_code = $sub_code . "),\n";
		$内容 = $sub_code;
		$字音 = array();
		
		foreach( $parts as $行 => $行音 )
		{
			$行 = str_replace( "。", "", $行 );
			$行音 = str_replace( ',', '', $行音 );
			$行音陣列 = explode( ' ', $行音[ 0 ] );
			
			for( $i = 0; $i < mb_strlen( $行 ); $i++ )
			{
				if( !array_key_exists( mb_substr( $行, $i, 1 ), $字音 ) )
				{
					$字音[ mb_substr( $行, $i, 1 ) ] = array();
				}
				if( !in_array( $行音陣列[ $i ], $字音[ mb_substr( $行, $i, 1 ) ] ) )
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
		$subcode = substr( $subcode, 0, -2 );
		$subcode = $subcode . "\n)";
		$内容 = $内容 . $subcode;
	}
	// 補充説明
	elseif( $補充説明 ) // a mixture of contents; just output it
	{
		$内容 = "\"$内容\"";
	}
	// 異文、夾注
	elseif( $異文、夾注 )
	{
		$題 = "版本";
		$版本陣列 = 提取版本詩文( $簡稱, $頁 );
		$内容 = "array(";
		
		if( array_key_exists( "詩題", $版本陣列 ) )
		{
			$内容 = $内容 . "\n\"詩題\"=>\"" . $版本陣列[ "詩題" ] . "\",";
		}
		
		// 詩文
		if( array_key_exists( "詩文", $版本陣列 ) )
		{
			if( !is_array( $版本陣列[ "詩文" ] ) )
			{
				$内容 = $内容 . "\n\"詩文\"=>\"" . 
					$版本陣列[ "詩文" ] . "\",";
			}
			else
			{
				$内容 = $内容 . "\n\"詩文\"=>array(";
				foreach( $版本陣列[ "詩文" ] as $詩文 )
				{
					$詩文 = implode( '。', $詩文 ) . '。';
					$内容 = $内容 . "\"${詩文}\",";
				}
				$内容 = $内容 . "),\n";
			}
		}
		$内容 = $内容 . ")";
	}
	// 坐標的轉換靠的是統一化詩文，因此出現在〖〗内的必須是
	// 我的統一化後的詩文。
	elseif( mb_strpos( $内容, '〖' ) !== false )
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
			// 計算坐標
			$詞條 = $parts[ 0 ];
			$詞條長度 = mb_strlen( $詞條 );
			$詞條坐標 = "";
			
			if( $詞條 == 1 ) //〖1〗題解
			{
				$詞條坐標 = "〚${頁}:1〛";
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
			else // 組合
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
				// look for the first matching 坐標
				foreach( $坐標s as $坐標 )
				{
					if( str_starts_with( $坐標, '〚' . $頁 ) )
					{
						$詞條坐標 = $坐標;
						break;
					}
				}
				$注釋 = $parts[ 0 ] . '：' . $parts[ 1 ];
			}
			
			$l = "\"${詞條坐標}\"=>\"${注釋}\",\n";
			
			$sub_code = $sub_code . $l;
		}
		$sub_code = substr( $sub_code, 0, -2 );
		$sub_code = $sub_code . ")\n";
		$内容 = $sub_code;
	}
	elseif( mb_strpos( $内容, '〚' ) !== false )
	{
		$〚儲存 = explode( '〚', $内容 );
		$sub_code = "array(\n";
		
		foreach( $〚儲存 as $l )
		{
			$l = trim( $l );
			
			if( $l == "" )
			{
				continue;
			}
			//$l = '〚' . $l ; // add 〚 back
			$parts = explode( '〛', $l );
			$l = "\"〚" . $頁 . ':' . $parts[ 0 ] . "〛\"=>\"" .
				$parts[ 1 ] . "\",\n";
			
			$sub_code = $sub_code . $l;
		}
		$sub_code = substr( $sub_code, 0, -2 );
		$sub_code = $sub_code . ")\n";
		$内容 = $sub_code;
	}
	else
	{
		$内容 = "\"$内容\"";
	}
	
	$code = $code . "\"$題\"=>\n$内容,\n";
}

	$code = $code . "\n);\n?>";
	//echo $out_path . "$頁.php", "\n";
	file_put_contents( $out_path . "$頁.php", $code );
}
?>