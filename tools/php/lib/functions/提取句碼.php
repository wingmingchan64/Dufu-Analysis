<?php
/*
 * 提取句碼，坐標中行碼後的値。
 */
use Dufu\Exceptions\InvalidCoordinateException;

function 提取句碼( string $坐標, bool $debug=false ) : string
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException(
			"「${坐標}」不是合法完整坐標。" );
	}
	if( !是有句碼之完整坐標( $坐標 ) )
	{
		throw new InvalidCoordinateException(
			"「${坐標}」不含句碼。" );
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

function get_sentence_id( string $坐標, bool $debug=false ) : string
{
	return 提取句碼( $坐標, $debug );
}
?>