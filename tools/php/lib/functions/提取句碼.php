<?php
/*
 * 提取行碼，坐標中最後一個 : 後的値。
 */
function 提取句碼( string $坐標 ) : string
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	
	if( 含首碼( $坐標 ) )
	{
		$regex = '/\d{4}:\d+:\d+.(\d)/u';
	}
	else
	{
		$regex = '/\d{4}:\d+.(\d)/u';
	}
	
	$matches = array();

	if( preg_match( $regex, $坐標, $matches ) )
	{
		return $matches[ 1 ];
	}
	else
	{
		// shouldn't be here
		throw new InvalidCoordinateException( "此坐標無句碼。" );
	}
}

function get_sentence_id( string $坐標 ) : string
{
	return 提取句碼( $坐標 );
}
?>