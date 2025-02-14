<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜詩詳註.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
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

foreach( $lines as $l )
{
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
		
		if( $默認頁碼 != '0042' )
		{ continue; }
	
		require_once( 詩集文件夾 . $默認頁碼 . 程式後綴 );
		$默認頁碼 = $l_array[ 1 ];
		$版本詩題 = $l_array[ 0 ];
		$版本詩題 = trim( $版本詩題 ) . ' ' . $默認頁碼 . ' ' .
			$l_array[ 2 ] . NL; }

		$默認詩文 = $内容[ 詩文 ];
		
		//echo $默認頁碼, NL;
		
		try
		{
			//echo $默認頁碼, NL;
		}
		catch( ErrorException $e )
		{
			echo '頁碼', $默認頁碼;
			exit;
		}
		
		$詩陣列  = $杜甫詩陣列[ $默認頁碼 ];
		$版本路徑 = 杜詩詳註 . $默認頁碼 . 程式後綴;
		if( file_exists( $版本路徑 ) )
		{
			$版本詩文 = '';
			$版本大意 = array(); // array
			$版本注釋 = array(); // array

			try
			{
				require_once( $版本路徑 );
				if( array_key_exists( 大意, $仇内容 ) )
				{
					$版本大意 = $仇内容[ 大意 ]; // array
					$坐標 = "〚${默認頁碼}:〛";
					$大意 = '';
					if( array_key_exists( $坐標, $版本大意 ) )
					{
						$大意 = $版本大意[ $坐標 ] . NL . NL;
						$大意 = 【大意】 . NL . $大意;
					}
					
				}
				if( array_key_exists( 注釋, $仇内容 ) )
				{
					$版本注釋 = $仇内容[ 注釋 ]; // array
				}
				
				$題解 = '';
				$坐標 = "〚${默認頁碼}:1〛";
				if( array_key_exists( $坐標, $版本注釋 ) )
				{
					$題解 = $版本注釋[ $坐標 ] . NL . NL;
					$題解 = 【題解】 . NL . $題解;
				}
				
				$版本異文、夾注 = $仇内容[ 版本 ][ 坐標版本異文、夾注 ];
				
				$版本詩文 = 提取版本詩文含夾注( $詩陣列, $版本異文、夾注, $版本注釋, true, false );
				$版本詩文 = 【詩文】 . NL . $版本詩文;
				
				$contents .= $版本詩題;
				$contents .= $題解;
				$contents .= $版本詩文 . NL . NL;
				$contents .= $大意;

				$counter = 1;
				
				$contents .= 【注釋】 . NL;
				
				foreach( $版本注釋 as $key => $value )
				{
					if( 提取行碼( $key ) == '1' )
					{
						continue;
					}
					$contents .= '[' . $counter . ']' .
						$value . NL;
					$counter++;
				}
				$contents .= NL . 【評論】 . NL;
				
				if( is_string( $仇内容[ 評論 ] ) )
				{
					$contents = $contents . $仇内容[ 評論 ] . NL . NL;
				}
				elseif( is_array( $仇内容[ 評論 ] ) )
				{
					$contents = $contents . 提取陣列値( $仇内容[ 評論 ] ) . NL . NL;
				}

			}
			catch( ErrorException $e )
			{
				echo $默認頁碼, NL;
				echo $e;
			}
		}

		
		/*
		$版本路徑 = 杜詩詳註 . $默認頁碼 . 程式後綴;
		
		if( file_exists( $版本路徑 ) )
		{
			try
			{
				require_once( $版本路徑 );
				
				
				
				if( is_string( $仇内容[ 評論 ] ) )
				{
					$content = $content . $仇内容[ 評論 ] . NL . NL;
				}
				elseif( is_array( $仇内容[ 評論 ] ) )
				{
					$content = $content . 提取陣列値( $仇内容[ 評論 ] ) . NL . NL;
				}
			}
			catch( ErrorException $e )
			{
				echo $默認頁碼, NL;
				echo $e, NL;
				continue;
			}
		}
		*/
	
}

$outfile = 杜詩詳註 . "杜詩詳註.txt";
file_put_contents( $outfile, $contents . 分隔線 );
/*$outfile = "H:\\github\\Dufu-Analysis\\王嗣奭《杜臆》\\" . "王嗣奭《杜臆》_帶詩文.txt";
file_put_contents( $outfile, $contents );
*/
?>

