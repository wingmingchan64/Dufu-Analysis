<?php
/*
 *
 */
function 是合法非完整坐標( string $str ) : bool
{
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );

	if( !in_array( $str, $非完整坐標表 ) )
	{
		return false;
	}
	return true;
}
?>