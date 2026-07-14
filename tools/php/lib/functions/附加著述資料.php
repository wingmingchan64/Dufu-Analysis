<?php
/*
 * JINGQUAN, 0001 
 */
use CTT\Exceptions\IllegalWorkIDException;

function 附加著述資料(
	string $默文碼,
	string $著述版文碼,
	array $m_paths,
	array &$樹 = null ) : array
{
	global $ctt_registry;
	$是組詩 = 是組詩( $默文碼 );
	
	[ $著述碼, $版文碼 ] = explode( 逗號, $著述版文碼 );
	$簡稱 = 提取數據結構( 著述碼_簡稱 )[ $著述碼 ];
	// error checking
	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	// 正文樹
	if( is_null( $樹 ) )
	{
		$樹 = 提取基準正文樹( $默文碼 );
		添加標點符號( $樹 );
		添加錨( $樹 );
	}
	
	// JINGQUAN_0002_注釋_0003,4,1,1-5_JINGQUAN,0002,3_insert
	foreach( $m_paths as $path )
	{
		// ignore $dummy1, $dummy2, $函式
		// focus on $部分, $範圍, $來源
		// use $部分 to group authors
		// $範圍: find 行碼, replace text with path
		[ $dummy1, $dummy2, $部分, $範圍, $來源, $函式 ] =
			explode( US, $path );
			
		//echo $部分, NL;
			
		// top-level a or text, no comma
		// a: 評論
		// 文字
		if( mb_strpos( $範圍, 逗號 ) === false )
		{
			// doc_id only
			// text, resolve it
			if( $範圍 != 樹錨名 )
			{
				if( intval( $範圍 ) )
				{
					echo "範圍爲文檔碼 " . $範圍 . NL;
					$路徑 = array( $範圍 );
					$路徑[] = 樹錨名;
				}
				// text
				else
				{
					//$size = mb_strlen( $範圍 );
					// could be just a
					$路徑 = 提取詩文唯一路徑( $默文碼, $範圍 );
					$路徑 = explode( 逗號, $路徑 );
					
					if( $是組詩 && count( $路徑 ) > 2 )
					{
						$路徑 = array_slice(
							$路徑, 0, 3 );
						/*
						$num = count( $路徑 ) - 1;
						$temp_path = '';
						
						for( $i = 0; $i < $num; $i++ )
						{
							$temp_path .= $路徑[ $i ] . 逗號;
						}
						
						$temp_path = rtrim( $temp_path, 逗號 );
						$句末字碼 = 提取路徑句字數( $temp_path );
						$first_last = explode( 分號, $路徑[ $num ] );
						
						if( $first_last[ 0 ] == '1' &&
							intval( $first_last[ 1 ] ) == $句末字碼 )
						{
							$路徑[ $num ] = 樹錨名;
						}
						*/
						$路徑[] = 樹錨名;
					}
					elseif( !$是組詩 &&
						count( $路徑 ) > 1 )
					{
						$路徑 = array_slice(
							$路徑, 0, 2 );
						$路徑[] = 樹錨名;
					}
				}
			}
			else
			{
				//echo "Top-level a here", NL;
				$路徑 = array( $範圍 );
			}
		}
		// has comma, but no a
		else
		{
			//echo "範圍 type b:" . $範圍, NL;

			$路徑 = explode( 逗號, $範圍 );
		
			// 0003,詩題 or 0003,3
			
			if( $是組詩 && count( $路徑 ) > 2 )
			{
				$路徑 = array_slice( $路徑, 0, 3 );
				$路徑[] = 樹錨名;
			}
			elseif( !$是組詩 && count( $路徑 ) > 1 )
			{
				$路徑 = array_slice( $路徑, 0, 2 );
				$路徑[] = 樹錨名;
			}
				
				// newly added
				// to avoid two 。
				/*
				elseif( $路徑[ 3 ] == $句末字碼 )
				{
					$路徑[ 3 ] = 樹錨名;
				}
				*/
			/*
			elseif( count( $路徑 ) == 5 )
			{
				$字parts = explode( 分號, $路徑[ 4 ] );
				$句路徑 = $路徑[0] . 逗號 . $路徑[1] . 逗號 .
						$路徑[2] . 逗號 . $路徑[3];
				$句末字碼 = 提取路徑句字數( $句路徑 );
					
				if( $字parts[ 0 ] == '1' && 
					intval( $字parts[ 1 ] ) == $句末字碼 )
				{
					$路徑[ 4 ] = 樹錨名;
				}
				else
				{
					$路徑[ 4 ] = $字parts[ 1 ];
				}
			}
			*/
		}
		
		$text = 提取ctt正文( $來源 );
			
		//if( !$replace )
		//{
			//$text =
				//"〈${部分}*${範圍}*${text}〉";
		//}
		// newly added
		//else
		//{
			//$text =
				//"〈replaced*${範圍}*${text}〉";
		//}
		$p = &$樹;
		
		if( $部分 == '題解' )
		{
			//print_r( $路徑 );
		}
		
		foreach( $路徑 as $step )
		{
			$p = &$p[ $step ];
		}
		
		if( $部分 == '題解' )
		{
			//print_r( $p );
		}

		
		if( is_array( $p ) &&
			!array_key_exists( $部分, $p ) )
		{
			植入路徑子樹( $樹, $路徑, array( $部分 => array() ) );
			//$p[ $部分 ] = array();
		}
		elseif( $p == '' )
		{
			$p = array( $部分 => array() );
		}
		
		
		// add $部分 to a
		if( !in_array( $部分, $路徑 ) )
		{
			$路徑[] = $部分;
		}

		//if( $路徑[ count( $路徑 ) - 1 ] == 樹錨名 )
		//{
		
		植入路徑子樹( $樹, $路徑, array( $簡稱 => $text ) );
		//}
	}
		
	return $樹;
}

function append_work_data(
	string $默文碼,
	string $著述版文碼,
	array $m_paths ) : array
{
	return 附加著述資料( $默文碼, $著述版文碼, $m_paths );
}
?>