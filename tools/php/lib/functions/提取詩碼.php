<?php
/*
 * 提取詩碼。
 */
function 提取詩碼( string $坐標 ) : string
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	
	if( 含首碼( $坐標 ) )
	{
		$regex = '/(\d{4}):(\d+):/u';
	}
	else
	{
		$regex = '/(\d{4}):/u';
	}
	
	$matches = array();

	if( preg_match( $regex, $坐標, $matches ) )
	{
		if( 含首碼( $坐標 ) )
		{
			return $matches[ 1 ] . '-' . $matches[ 2 ];
		}
		else
		{
			return $matches[ 1 ];
		}
	}
	else
	{
		// shouldn't be here
		throw new InvalidCoordinateException( "此坐標無詩碼。" );
	}
}

function get_poem_id( string $坐標 ) : string
{
	return 提取詩碼( $坐標 );
}
?>