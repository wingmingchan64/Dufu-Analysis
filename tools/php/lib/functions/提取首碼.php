<?php
/*
 * 提取首碼，坐標中 :X: 的 X 値。1-20。
 */
function 提取首碼( string $坐標 ) : string
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	
	if( 含首碼( $坐標 ) )
	{
		$regex = '/\d{4}:(\d+):/u';
		$matches = array();
		if( preg_match( $regex, $坐標, $matches ) )
		{
			return $matches[ 1 ];
			
		}
		else
		{
			// shouldn't be here
			throw new InvalidCoordinateException( "不是組詩坐標。" );
		}
	}
	else
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
}

function get_poem_order_id( string $坐標 ) : string
{
	return 提取首碼( $坐標 );
}
?>