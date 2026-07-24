<?php
/*
 * JINGQUAN, 0001 
 */
use CTT\Exceptions\IllegalWorkIDException;
use CTT\Exceptions\IllegalLineIDException;

function 附加著述資料(
	string $默文碼,
	string $著述版文碼,
	array $m_paths,
	array &$樹 ) : bool
{
	global $ctt_registry;
	
	$是組詩 = 是組詩( $默文碼 );
	$root_node_group = array(
		"鑒賞", "年譜", "辨疑", "結構", "參考", "引典", "詞典"
	);
	
	[ $著述碼, $版文碼 ] = explode( 逗號, $著述版文碼 );
	$簡稱 = 提取數據結構( 著述碼_簡稱 )[ $著述碼 ];
	// error checking
	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	
	// JINGQUAN_0002_注釋_0003,4,1,1-5_JINGQUAN,0002,3_insert
	foreach( $m_paths as $path )
	{
		// ignore $dummy1, $dummy2, $函式
		// focus on $部分, $範圍, $來源
		// use $部分 to group authors
		// $範圍: find 行碼, replace text with path
		$parts = explode( US, $path );
		$開始 = '';
		
		if( count( $parts ) == 6 )
		{
			[ $dummy1, $dummy2, $部分, $範圍, $來源, 
				$函式 ] = $parts;
		}
			
		if( in_array( $部分, $root_node_group ) )
		{
			if( $部分 == "引典" )
			{
				$開始 = 修復文字( $函式 );
				// $來源:SFJL,01,57
				// $來源:SFJL,01,57,124
				$來源陣列 = explode( ',', $來源 );
				$來源著述碼_段碼 = array_slice( $來源陣列, 0, 2 );
				$用行 = false;
				$引文行碼 = 0;
				
				if( count( $來源陣列 ) == 4 )
				{
					$用行 = true;
					$引文行碼 = $來源陣列[ 3 ];
					$來源陣列 = array_splice(
						$來源陣列, 3, 1 );
				}
				
				$篇名 = 
					提取ctt正文( implode( ',', $來源著述碼_段碼 ) . ',篇名' );
				$引文 = 修復文字( 提取ctt正文( $來源 ) );
				
				/*
				echo $開始, NL;
				echo $引文行碼, NL;
				echo $引文, NL;
				*/
				
				if( $開始 != '' &&
					mb_strpos( $引文, $開始 ) !== 0 )
				{
					throw new IllegalLineIDException(
						"${默文碼}:${來源}的引文「${引文}」中沒有「${開始}」。"
					);
				}
					
				//$路徑 = array( 樹錨名, $篇名 );
				// $範圍:38
				if( !array_key_exists(
					$部分, $樹[ 樹錨名 ] ) )
				{
					$樹[ 樹錨名 ][ $部分 ] = array();
				}
				//echo 樹錨名, NL;
				//echo $部分, NL;
				//echo $篇名, NL;
				// empty array
				//print_r( $樹[ 樹錨名 ][ $部分 ] );
				
				//continue;
				if( !array_key_exists(
					$範圍, $樹[ 樹錨名 ][ $部分 ] ) )
				{
					$樹[ 樹錨名 ][ $部分 ][ $範圍 ] = array();
				}
				
				if( !array_key_exists(
					$篇名, $樹[ 樹錨名 ][ $部分 ][ $範圍 ] ) )
				{
					$樹[ 樹錨名 ][ $部分 ][ $範圍 ][ $篇名 ] = array();
				}
				
				if( !$用行 )
				{
					// subtree
					$引文 = 提取ctt子樹( $來源 );
					$樹[ 樹錨名 ][ $部分 ][ $範圍 ][ $篇名 ][] = $引文;
				}
				else
				{
					// text
					$樹[ 樹錨名 ][ $部分 ][ $範圍 ][ $篇名 ]
						[ $引文行碼 ] = $引文;
				}
			}
			else
			{
				// $範圍 is a
				$路徑 = array( $範圍, $部分 );
				//echo $部分, NL;
				
				if( $樹[ $範圍 ] == '' )
				{
					$樹[ $範圍 ] = array();
				}
				
				if( !array_key_exists( $部分, $樹[ $範圍 ] ) )
				{
					$樹[ $範圍 ][ $部分 ] = array();
				}
				
				$子樹 = array( $簡稱 => 提取ctt子樹( $來源 ) );
				植入路徑子樹( $樹, $路徑, $子樹 );
			}
		}
		else
		{
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
						// could be just a
						$路徑 = 提取詩文唯一路徑( $默文碼, $範圍 );
						$範圍 = $路徑;
						$路徑 = explode( 逗號, $路徑 );
						
						if( $是組詩 && count( $路徑 ) > 2 )
						{
							$路徑 = array_slice(
								$路徑, 0, 3 );
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
					$路徑 = array( $範圍 );
				}
			}
			// has comma, but no a
			else
			{
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
			}
			
			$text = 提取ctt正文( $來源 );
			$text = "〈${部分}*${範圍}*${text}〉";
			$p = &$樹;
			
			foreach( $路徑 as $step )
			{
				$p = &$p[ $step ];
			}
			
			if( is_array( $p ) &&
				!array_key_exists( $部分, $p ) )
			{
				植入路徑子樹( 
					$樹, $路徑, array( $部分 => array() ) );
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

			植入路徑子樹( $樹, $路徑, array( $簡稱 => $text ) );
		}
	}
	return true;
}

function append_work_data(
	string $默文碼,
	string $著述版文碼,
	array $m_paths ) : bool
{
	return 附加著述資料( $默文碼, $著述版文碼, $m_paths );
}
?>