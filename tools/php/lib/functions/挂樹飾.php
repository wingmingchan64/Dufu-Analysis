<?php
/*
 * JINGQUAN, 0001 
 */
use CTT\Exceptions\IllegalWorkIDException;

function 挂樹飾(
	string $默文碼,
	string $著述版文碼,
	array $m_paths,
	array &$樹 = null ) : array
{
	global $ctt_registry;
	
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
	
	foreach( $m_paths as $path )
	{
		[ $dummy1, $dummy2, $部分, $範圍, $來源, $函式 ] =
			explode( US, $path );
		$replace = ( $函式 == 'replace' );
		
		// 0003, 契闊
		if( mb_strpos( $範圍, 逗號 ) === false )
		{
			if( $範圍 != 樹錨名 )
			{
				if( intval( $範圍 ) )
				{
					$路徑 = array( $範圍 );
					$路徑[] = 樹錨名;
				}
				else
				{
					$size = mb_strlen( $範圍 );
					$路徑 = 提取詩文唯一路徑( $默文碼, $範圍 );
					$路徑 = explode( 逗號, $路徑 );
					// 有 -
					if( $size > 1 )
					{
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
					}
				}
			}
			else
			{
				$路徑 = array( $範圍 );
			}
		}
		else
		{
			$路徑 = explode( 逗號, $範圍 );
		
			// 0003,詩題 or 0003,3
			if( count( $路徑 ) == 2 || count( $路徑 ) == 3 )
			{
				$路徑[] = 樹錨名;
			}
			elseif( count( $路徑 ) == 4 )
			{
				$句路徑 = $路徑[0] . 逗號 . $路徑[1] . 逗號 . $路徑[2];
				$句末字碼 = 提取路徑句字數( $句路徑 );

				// 0003,3,1,1-3
				if( strpos( $路徑[ 3 ], 分號 ) 
					!== false )
				{
					$字parts = explode( 分號, $路徑[ 3 ] );
					
					if( $字parts[ 0 ] == '1' && 
						intval( $字parts[ 1 ] ) == $句末字碼 )
					{
						$路徑[ 3 ] = 樹錨名;
					}
					else
					{
						$路徑[ 3 ] = $字parts[ 1 ];
					}
				}
				// newly added
				// to avoid two 。
				elseif( $路徑[ 3 ] == $句末字碼 )
				{
					$路徑[ 3 ] = 樹錨名;
				}
			}
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
		}
		
		$text = 提取ctt正文( $來源 );
			
		if( !$replace )
		{
			$text =
				"〈${部分}*${範圍}*${text}〉";
		}
		// newly added
		else
		{
			//$text =
				//"〈replaced*${範圍}*${text}〉";
		}

		if( $函式 == 'insert' )
		{
			if( $路徑[ count( $路徑 ) - 1 ] == 樹錨名 )
			{
				植入路徑子樹( $樹, $路徑, array( $簡稱 => $text ) );
			}
			else
			{
				插入路徑字( $樹, $路徑, $text );
			}
		}
		elseif( $函式 == 'replace' )
		{
			替換路徑字( $樹, $路徑, $text );
		}
	}
		
	return $樹;
}

function attach_tree_ornaments(
	string $默文碼,
	string $著述版文碼,
	array $m_paths ) : array
{
	return 挂樹飾( $默文碼, $著述版文碼, $m_paths );
}
?>