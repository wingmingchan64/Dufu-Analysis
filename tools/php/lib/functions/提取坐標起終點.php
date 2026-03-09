<?php
/*
 * 回傳$坐標範圍的起點、重點。
 * $坐標的範圍不能到詩的層次，不能是全詩；必須有行碼，範圍在行或行以下。
 */
use Dufu\Exceptions\InvalidCoordinateException;

function 提取坐標起終點( string $坐標, bool $debug=false ) : array
{
	if( !是合法完整坐標( $坐標 ) )
	{
		throw new InvalidCoordinateException(
			"坐標「${坐標}」不存在。"
		);
	}
	
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	$首碼 = '';
	
	if( 是組詩( $文檔碼 ) )
	{
		$首碼 = 提取首碼( $坐標 ) . ':';
	}
	
	$行碼 = 提取首碼( $坐標 );
	
	// 〚0276:19-20〛
	if( 是含範圍行碼完整坐標( $坐標 ) )
	{
		$行碼s = explode( '-', $行碼 );
		$起行碼 = $行碼s[ 0 ];
		$終行碼 = $行碼s[ 1 ];
		$起句碼 = '1.';
	}
	else
	{
		// 〚0276:19〛
		$起行碼 = $行碼;
		$終行碼 = $行碼;
		
		// 〚0276:19.1〛
		if( !是有句碼之完整坐標( $坐標 ) )
		{
			//$句碼
		}
	}
	
	$起終點 = array();

	
	
}
?>