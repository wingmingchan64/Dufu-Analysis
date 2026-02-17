<?php
/*
 * 
 */
function 只有詩碼之完整坐標(  string $坐標 ) : bool 
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	$裸坐標 = rtrim( ltrim( trim( $坐標 ), '〚' ), ':〛' );
	$parts = explode( ':', $裸坐標 );
	$size = sizeof( $parts );
	
	return ( $size == 1 || $size == 2 );
}
?>