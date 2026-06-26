<?php
/*
 * 沿著路徑，於末端插入文字。
 */
 use Dufu\Exceptions\InvalidPathException;

function 植入路徑子樹( 
	array &$陣列, array $路徑, 
	array $子樹, bool $debug=false ) : bool
{
	$pointer = &$陣列;
	
	foreach( $路徑 as $step )
	{
		$pointer = &$pointer[ $step ];
	}
	
	foreach( $子樹 as $k => $v )
	{
		if( is_array( $pointer ) )
		{
			if( array_key_exists( $k, $pointer ) )
			{
				$pointer[ $k ] = $pointer[ $k ] . $v;
			}
			else
			{
				$pointer[ $k ] = $子樹[ $k ];
			}
		}
		else
		{
			$pointer = $子樹;
		}
	}
	
	return true;
}

function insert_subtree_by_path(
	array &$陣列, array $路徑, array $子樹, bool $debug=false ) : bool
{
	return 插入路徑字( $陣列, $路徑, $子樹, $debug );
}
?>