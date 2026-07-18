<?php
/*
 * JINGQUAN, 0001 
 */
use CTT\Exceptions\IllegalWorkIDException;

function 附加著述資料(
	string $默文碼,
	string $著述版文碼,
	array $m_paths,
	array &$樹 ) : bool
{
	global $ctt_registry;
	
	$是組詩 = 是組詩( $默文碼 );
	$root_node_group = array(
		"鑒賞", "年譜", "辨疑", "結構", "參考"
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
		[ $dummy1, $dummy2, $部分, $範圍, $來源, $函式 ] =
			explode( US, $path );
			
		if( in_array( $部分, $root_node_group ) )
		{
			// $範圍 is a
			$路徑 = array( $範圍, $部分 );
			echo $部分, NL;
			
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