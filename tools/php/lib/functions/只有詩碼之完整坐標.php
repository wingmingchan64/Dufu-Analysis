<?php
/*
 * 〚0003:〛, 〚0013:1:〛 returns true
 * 〚0002:〛, 〚0013:〛 returns false
 */
function 只有詩碼之完整坐標( string $坐標, bool $debug=false ) : bool
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	
	// 組詩成員九個字符
	if( 是組詩( $文檔碼 ) )
	{
		try
		{
			$首碼 = 提取首碼( $坐標 );
			return ( mb_strlen( $坐標 ) == 
				mb_strlen( "〚${文檔碼}:${首碼}:〛" ) );
		}
		catch( InvalidCoordinateException $e )
		{
			return false;
		}
	}
	// 非組詩成員七個字符
	else
	{
		return ( mb_strlen( $坐標 ) == 7 );
	}
}

function is_complete_coords_with_only_poem_id( string $坐標, bool $debug=false ) : bool
{
	return 只有詩碼之完整坐標( $坐標, $debug );
}
?>