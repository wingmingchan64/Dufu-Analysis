<?php
/*
 * 
 */
function 替換路徑文字( 
	array &$陣列, array $路徑, string $文字, int $start = 0 ) : bool
{
	if( $start == sizeof( $路徑 ) - 1 )
	{
		$陣列[ $路徑[ $start ] ] = $文字;
	}
	else
	{
		替換路徑文字( $陣列[ $路徑[ $start ] ], $路徑, $文字, $start + 1 );
	}

	return true;
}
?>