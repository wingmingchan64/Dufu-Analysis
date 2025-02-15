<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜詩詳註.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 詩組_詩題 );
require_once( 帶序文之詩歌 );
require_once( 杜甫詩陣列 );

/**
詩題
注釋〚0013:1〛// 題解
// 首碼參詩組_詩題
大意〚0013:1:〛〚0013:2:〛〚0053:3-4〛〚0053:5-8〛
詩文〚0013:1:〛
注釋〚0013:1:〛
評論〚0013:1:〛
*/

$text     = getFile( 'H:\杜甫資料庫\仇兆鰲《杜詩詳註》\仇目錄.txt' );
$lines    = explode( "\n", $text );
$store    = array();
$contents = '';
$file_name = '';

foreach( $lines as $l )
{
	/*
	if( $l == '' && $file_name != '' )
	{
		$outfile = 杜詩詳註 . "${file_name}.txt";
		file_put_contents( $outfile, $contents . 分隔線 );
		$contents = '';
	}
	elseif( mb_strpos( $l, '//' ) === false && 
		mb_strpos( $l, '卷之' ) !== false )
	{
		$file_name = trim( $l );
	}
	*/
	if( $l == '' || mb_strpos( $l, '//' ) === false )
	{
		continue;
	}
	else // only lines with //
	{
		$l       = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		$默認頁碼  = trim( $l_array[ 1 ] );
		
		if( $l_array[ 1 ] == '6497' )
		{
			continue;
		}
		
		//if( $默認頁碼 != '0013' )
		//if( $默認頁碼 == '0136' )
		// 0059 0062  0079 0099 0095 0120 0111 0144 0148 0161 0209
		if( $默認頁碼 != '0059' )
		{ continue; }
	
		if( $默認頁碼 == '0136' )
		{ break; }
	
		$詩陣列 = $杜甫詩陣列[ $默認頁碼 ];
		
		if( $默認頁碼 == '0059' )
		{
			$詩陣列[ 序言 ] = "天寶初，南曹小司寇舅於我太夫人堂下壘[一作累]土爲山，一匱[一作簣]盈尺，以代彼朽木，承諸焚香瓷甌，甌甚安矣。旁植慈竹，蓋茲數峯，嶔岑嬋娟，宛有塵外[一有數字，一有格字]致。乃不知興[去聲]之所至，而作是詩。" . NL . NL . 【注釋】 .
			"《舊唐書》：吏部員外郎二員，一人主判南曹。注：以在選曹之南，故曰南曹。◯朱注：唐制未聞以司寇判南曹。權德輿《吏部南曹廳壁記》云：高宗上元初，請外郎一人顓南曹之任，其後或詔他曹郎權居之。此云南曹小司寇，當是以秋官權職者。◯太夫人盧氏，公祖審言繼室，天寶三載五月卒於陳留郡之私第，公作墓誌。◯嶔岑，謂山。嬋娟，謂竹。◯申涵光曰：序不易解。杜文長至數語，便期期不能達意。如「夔人屋璧」、「平章鄭氏女子」、「公孫大娘」等篇，世人附會以爲古，其實不明。詩小序，莫妙於元次山，杜短語多有佳者。";
		}
		//print_r( $詩陣列 );
		
		// 詩題 from 目錄
		$版本詩題 = $l_array[ 0 ];
		// 加版本頁碼
		$版本詩題 = trim( $版本詩題 ) . ' ' . $默認頁碼 . ' ' .
			$l_array[ 2 ] . NL; 
		// 提取版本資料
		$版本路徑 = 杜詩詳註 . $默認頁碼 . 程式後綴;

try
{
		if( file_exists( $版本路徑 ) )
		{
			$版本詩文 = '';
			$版本大意 = array(); // array
			$版本注釋 = array(); // array
			// 準備各個部分
			require_once( $版本路徑 );
			$是詩組 = array_key_exists( $默認頁碼, $詩組_詩題 );
				
			if( $是詩組 )
			{
				$首數 = sizeof( $詩陣列 ) - 1; // 詩題
				$副題 = array();
				foreach( $詩陣列 as $key => $value )
				{
					// 儲存詩組副題
					if( $key != 詩題 )
					{
						$副題[ $key ] = $詩陣列[ $key ][ 副題 ];
					}
				}
			}
			
			// 【序言】
			$帶序文 = in_array( $默認頁碼, $帶序文之詩歌[ '頁碼' ] );
			$序言 = '';
										
			// 詩組:每首各有大意, 分別顯示
			// 分段:行碼
			$是分段 = false;
			if( array_key_exists( 大意, $仇内容 ) )
			{
				$版本大意 = $仇内容[ 大意 ]; // array
				if( is_array( $版本大意 ) )
				{
					$是分段 = ( sizeof( array_keys( $版本大意 ) ) > 1 );
				}
			}
			
			// 【注釋】
			$版本注釋 = array();
			if( array_key_exists( 注釋, $仇内容 ) )
			{
				$注釋 = $仇内容[ 注釋 ]; // array
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
				if( 提取行碼( $key ) == '1' )
				{
					continue;
				}
				$版本注釋[ $key ] = "[${counter}]" . $value;
				$counter++;
			}
			$分段注釋 = array();
			//print_r( $版本注釋 );
				
			if( $是詩組 )
			{
				$分段注釋 = 分割注釋( array_keys( $詩陣列 ), $版本注釋 );
			}
			elseif( $是分段 )
			{
				$分段注釋 = 分割注釋( array_keys( $版本大意 ), $版本注釋 );
				//print_r( array_keys( $版本大意 ) );
			}
			//print_r( $分段注釋 );
			
			$版本異文、夾注 = $仇内容[ 版本 ][ 坐標版本異文、夾注 ];
			
			if( !$是詩組 )
			{
				$版本詩文陣列 = 提取版本詩文含夾注陣列( 
					$詩陣列, $版本異文、夾注, $版本注釋, true, false );
					
				//if( $默認頁碼 == '0053' )
				//print_r( $版本詩文陣列 );
				//exit;
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
					if( is_array( $子列陣 ) )
					{
						$版本詩文 .= $子列陣[ '副題' ] . NL;
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
			
			// 【評論】
			$評論 = 【評論】 . NL;
			
			if( array_key_exists( '評論', $仇内容 ) && 
				is_string( $仇内容[ '評論' ] ) )
			{
				$評論 .= $仇内容[ '評論' ] . NL;
			}
				
				
			// 詩組分段
			if( $是詩組 )
			{
				
			}
			else
			{
				
			}
		}
		
		$contents .= $版本詩題;
		$contents .= $題解 . NL;
		
		if( $是詩組 )
		{
			$首數 = sizeof( $詩組_詩題[ $默認頁碼 ][ 1 ] );
			
			for( $i = 1; $i <= $首數; $i++ )
			{
				$contents .= 【詩文】 . NL;
				$contents .= $詩文列陣[ $i - 1 ];
				$contents .= 【大意】 . NL;
				$碼 = "〚${默認頁碼}:${i}:〛";
				$contents .= $版本大意[ $碼 ] . NL . NL;
				$contents .= 【注釋】 . NL;
				$contents .= implode( NL, $分段注釋[ $i ] ) . NL . NL;
				$contents .= 【評論】 . NL;
				$contents .= $仇内容[ '評論' ][ $碼 ] . NL . NL;
				
			}
			//$contents .= 分隔線;
		}
		elseif( $是分段 && !$是詩組 )
		{
			$段數 = sizeof( array_keys( $分段注釋 ) );
			$段落坐標 = array_keys( $仇内容[ '大意' ] );
			
			for( $i = 1; $i <= $段數; $i++ )
			{
				$contents .= 【詩文】 . NL;
				$contents .= 杜甫詩陣列行至行ToString( 
						$版本詩文陣列, $段落坐標[ $i - 1 ], true, false ) . NL . NL;
					//$詩陣列
					//print_r( $版本詩文陣列 );
				$contents .= 【大意】 . NL;
				$contents .= $版本大意[ $段落坐標[ $i - 1 ] ] . NL . NL;
				$contents .= 【注釋】 . NL;
				//print_r( $分段注釋 );
				$contents .= implode( NL, $分段注釋[ $段落坐標[ $i - 1 ] ] ) . NL . NL;
				
				if( is_array( $仇内容[ '評論' ] ) )
				{
					$contents .= 【評論】 . NL;
					$contents .= $仇内容[ '評論' ][ $段落坐標[ $i - 1 ] ] . NL . NL;
				}
			}
			if( array_key_exists( '評論', $仇内容 ) &&
				!is_array( $仇内容[ '評論' ] ) )
			{
				$contents .= 【評論】 . NL;
				$contents .= $仇内容[ '評論' ] . NL . NL;
			}
		}
		else
		{
			//$contents .= $題解 . NL;
			$contents .= $版本詩文 . NL . NL;
			$contents .= $大意;
			$contents .= 【注釋】 . NL;
			foreach( $版本注釋 as $坐標 => $注釋 )
			{
				$contents .= $注釋 . NL;
			}
			$contents .= NL . $評論;
			//$contents .= 分隔線;
		}
		$contents .= 分隔線;
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

$outfile = 杜詩詳註 . "杜詩詳註.txt";
file_put_contents( $outfile, $contents );
/*$outfile = "H:\\github\\Dufu-Analysis\\王嗣奭《杜臆》\\" . "王嗣奭《杜臆》_帶詩文.txt";
file_put_contents( $outfile, $contents );
*/
?>

