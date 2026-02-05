<?php
/*
 *
 */
function 後設標記轉換成陣列(
	string $文檔碼,
	string $默文檔碼,
	string $後設標記,
	string $文字 ) : array
{
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
	if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
	{
		throw new InvalidAnchorValueException( "「${默文檔碼}」不合法。" );
	}
	//$完整坐標表 = 提取數據結構( 完整坐標表 );
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );
	$後設陣列 = array();
	//echo $後設標記, NL;
	$pairs = explode( ';', $後設標記 );
	//print_r( $pairs );
	foreach( $pairs as $pair )
	{
		$後設陣列[ 't' ] = $文字;
		$k_v = explode( ':', $pair );
		
		if( sizeof( $k_v ) == 2 )
		{
			// process anchors
			if( $k_v[ 0 ] == 'a' )
			{
				$錨値 = '';
				// 詩題、序言
				if( $k_v[ 1 ] == '1' || $k_v[ 1 ] == '3' )
				{
					$行 = $k_v[ 1 ];
					$錨値 = "〚${默文檔碼}:${行}〛";
				}
				// 完整坐標
				elseif( 是完整坐標( $k_v[ 1 ] ) && 是合法完整坐標( $k_v[ 1 ] ) )
				{
					$錨値 = $k_v[ 1 ];
				}
				// 非完整坐標表，補文檔碼
				elseif( in_array( $k_v[ 1 ], $非完整坐標表 ) )
				{
					$完整坐標 = 生成完整坐標( $k_v[ 1 ], $默文檔碼 );
					if( 是合法完整坐標( $完整坐標 ) )
					{
						$錨値 = $完整坐標;
					}
					else
					{
						throw new InvalidAnchorValueException( "「${完整坐標}」不合法。" );
					}
				}
				// 文字
				else
				{
					$r = in_array( $k_v[ 1 ], $詩文組合 );
					// 詩文
					if( $r )
					{
						// 詩文 => 坐標
						$坐標s = 提取詩文坐標( $默文檔碼, $k_v[ 1 ] );
						
						if( sizeof( $坐標s ) == 1 )
						{
							$錨値 = $坐標s[ 0 ];
						}
						else
						{
							throw new InvalidAnchorValueException( 
													"「${k_v[ 1 ]}」不合法。" );
						}
					}
					
				}
				$後設陣列[ $k_v[ 0 ] ] = $錨値;
			}
			else
			{
				$後設陣列[ $k_v[ 0 ] ] = $k_v[ 1 ];
			}
		}
	}

	return $後設陣列;
}
?>