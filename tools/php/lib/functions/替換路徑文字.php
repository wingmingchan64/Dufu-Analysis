<?php
/*
 * 
 */
function 替換路徑文字( 
	array &$陣列, string $詩碼, array $路徑, string $文字 ) : bool
{
	$size = sizeof( $路徑 );
	
	if( $size == 5 )
	{
		$陣列[ $詩碼 ][ $路徑[ 0 ] ][ $路徑[ 1 ] ]
			[ $路徑[ 2 ] ][ $路徑[ 3 ] ][ $路徑[ 4 ] ] =
			$文字;
	}
		
	elseif( $size == 4 )
	{
		$陣列[ $詩碼 ][ $路徑[ 0 ] ][ $路徑[ 1 ] ]
			[ $路徑[ 2 ] ][ $路徑[ 3 ] ] =
			$文字;
	}
	return true;
}
?>