<?php
/*
 * used by 插入詩陣列文字
 */
function 插入路徑文字( 
	array &$陣列, 
	array $路徑, 
	string $文字, 
	int $start = 0,
	bool $debug = false
) : bool
{
	if( $start == sizeof( $路徑 ) - 1 )
	{
		debug_echo( __FILE__, __LINE__, $start, $debug );

		//$陣列[ $路徑[ $start ] ] = $陣列[ $路徑[ $start ] ] . $文字;
	}
	else
	{
		//插入路徑文字( $陣列[ $路徑[ $start ] ], $路徑, $文字, $start + 1 );
	}

	return true;
}
?>