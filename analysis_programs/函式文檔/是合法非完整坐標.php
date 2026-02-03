<?php
function 是合法非完整坐標( array $坐標陣列, string $str ) : bool
{
	if( !in_array( $str, $坐標陣列 ) )
	{
		return false;
	}
	return true;
}
?>