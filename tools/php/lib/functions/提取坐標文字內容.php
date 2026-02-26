<?php
/*
 * 
 */
function 提取坐標文字內容( string $坐標, bool $debug=false ) : string
{
	if( !是合法完整坐標( $坐標 ) )
	{
		throw new InvalidCoordinateException( "坐標「${坐標}」不存在。" );
	}
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	$是組詩 = 是組詩( $文檔碼 );
	$詩碼 = 提取詩碼( $坐標 );
	$詩陣列 = 提取數據結構( BASE_TEXT_DIR . $詩碼 );
	$temp = '';
	
	// 字
	if( 是含範圍字碼完整坐標( $坐標 ) )
	{
		debug_echo( __FILE__, __LINE__, "範圍字碼", $debug );

		$字碼_詩字 = 提取數據結構( 字碼_詩字 );
		$標s = 提取擴充範圍字碼坐標( $坐標 );
		
		foreach( $標s as $標 )
		{
			$temp .= $字碼_詩字[ $文檔碼 ][ $標 ];
		}
		return $temp;
	}
	elseif( 有字碼之完整坐標( $坐標 ) )
	{
		debug_echo( __FILE__, __LINE__, "字碼", $debug );
		$字碼_詩字 = 提取數據結構( 字碼_詩字 );
		return $字碼_詩字[ $文檔碼 ][ $坐標 ];
	}
	// 句
	elseif( 只有詩碼行碼句碼之完整坐標( $坐標 ) )
	{
		$句碼_詩句 = 提取數據結構( 句碼_詩句 );
		return $句碼_詩句[ $文檔碼 ][ $坐標 ];
	}
	//行
	elseif( 只有詩碼行碼之完整坐標( $坐標 ) )
	{
		debug_echo( __FILE__, __LINE__, "行碼", $debug );
		$行碼_詩文 = 提取數據結構( 行碼_詩文 );
		
		if( 是含範圍行碼完整坐標( $坐標 ) )
		{
			$標s = 提取擴充範圍行碼坐標( $坐標 );
			
			foreach( $標s as $標 )
			{
				$temp .= $行碼_詩文[ $文檔碼 ][ $標 ];
			}
			return $temp;
		}
		else
		{
			return $行碼_詩文[ $文檔碼 ][ $坐標 ];
		}
	}
	// 首
	else
	{
		debug_echo( __FILE__, __LINE__, "首碼", $debug );
		//debug_print_r( __FILE__, __LINE__, $詩陣列, $debug );
		try
		{
			if( $是組詩 )
			{
				// array
				$temp = 提取詩陣列詩文( $詩陣列[ $文檔碼 ], true, false, true, $debug );
			}
		}
		catch( ErrorException $e )
		{
			throw new InvalidCoordinateException( "坐標「${坐標}」不是詩文坐標。" );
		}
	}
	return implode( $temp );
}

function get_text_with_coords( string $坐標, bool $debug=false ) : string
{
	return 提取坐標文字內容( $坐標, $debug );
}
?>