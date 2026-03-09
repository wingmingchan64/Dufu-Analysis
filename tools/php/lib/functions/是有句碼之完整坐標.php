<?php
/*
 * no exception thrown
 */
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidCoordinateException;

function 是有句碼之完整坐標( 
	string $坐標, bool $debug=false ) : bool 
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		return false;
	}
	
	$裸坐標 = rtrim( ltrim( trim( $坐標 ), '〚' ), '〛' );
	$裸坐標 = rtrim( $裸坐標, ':' );
	$裸坐標 = str_replace( '.', ':', $裸坐標 );
	$parts = explode( ':', $裸坐標 );
	$size = sizeof( $parts );
	
	if( 是組詩( $parts[ 0 ] ) )
	{
		return ( $size > 4 );
	}
	return ( $size > 3 );
}

function is_complete_coords_with_segment_id( 
	string $坐標, bool $debug=false ) : bool 
{
	return 是有句碼之完整坐標( $坐標, $debug );
}
?>