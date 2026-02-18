<?php
/*
 * 
 */
function 有字碼之完整坐標(  string $坐標 ) : bool 
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
		echo $parts[ 0 ], NL;
		return ( $size == 5 );
	}
	return ( $size == 4 );
}
?>