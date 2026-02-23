<?php
/*
 * Returns true if 完整坐標 contains 句碼 as the last part.
 */
function 只有詩碼行碼句碼之完整坐標(  string $坐標 ) : bool 
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	$裸坐標 = rtrim( ltrim( trim( $坐標 ), '〚' ), '〛' );
	$裸坐標 = rtrim( $裸坐標, ':' );
	$裸坐標 = str_replace( '.', ':', $裸坐標 );
	$parts = explode( ':', $裸坐標 );
	$size = sizeof( $parts );
	
	if( 是組詩( $parts[ 0 ] ) )
	{
		return ( $size == 4 );
	}
	return ( $size == 3 );
}

function is_complete_coords_with_only_poem_id_line_id_segment_id( string $坐標 ) : bool
{
	return 只有詩碼行碼句碼之完整坐標( $坐標 );
}
?>