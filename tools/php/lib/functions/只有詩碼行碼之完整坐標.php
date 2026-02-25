<?php
/*
 * Returns true if 完整坐標 contains 行碼 as the last part.
 */
function 只有詩碼行碼之完整坐標( string $坐標, bool $debug=false ) : bool
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	$裸坐標 = rtrim( ltrim( trim( $坐標 ), '〚' ), '〛' );
	$裸坐標 = rtrim( $裸坐標, ':' );
	$parts = explode( ':', $裸坐標 );
	$size = sizeof( $parts );
	
	// 組詩成員三個部分
	if( 是組詩( $parts[ 0 ] ) )
	{
		return ( $size == 3 );
	}
	// 非組詩成員兩個部分
	return ( $size == 2 );
}

function is_complete_coords_with_only_poem_id_line_id( string $坐標, bool $debug=false ) : bool
{
	return 只有詩碼行碼之完整坐標( $坐標, $debug );
}
?>