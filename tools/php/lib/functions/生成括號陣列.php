<?php
/*
 * 此函式可保證括號是一對的。
 */
function 生成括號陣列( string $brackets ) : array
{
	if( ! 是括號( $brackets ) )
	{
		return array( '', '' );
	}
	return array( mb_substr( $brackets, 0, 1 ), 
		mb_substr( $brackets, 1 ) );
}
?>