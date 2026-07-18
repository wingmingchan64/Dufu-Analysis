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
	//print_r( $路徑 );
	//print_r( $子樹 );
	
	//echo "tree", NL;
	//print_r( $陣列 );
	
	foreach( $路徑 as $step )
	{
		if( is_array( $pointer ) )
		{
			$pointer = &$pointer[ $step ];
		}
	}
	
	foreach( $子樹 as $k => $v )
	{
		if( is_array( $pointer ) )
		{
			if( array_key_exists( $k, $pointer ) )
			{
				if( is_string( $v ) )
				{
					$pointer[ $k ] = $pointer[ $k ] . $v;
				}
			}
			else
			{
				//echo '1b', NL;
				//echo $k, NL;
				//$temp = $pointer;
				$pointer[ $k ] = $子樹[ $k ];
				//print_r( $temp );
			}
		}
		else
		{
			$pointer = $子樹;
		}
	}
	//print_r( $陣列 );
	return true;
}

function insert_subtree_by_path(
	array &$陣列, array $路徑, array $子樹, bool $debug=false ) : bool
{
	return 插入路徑字( $陣列, $路徑, $子樹, $debug );
}
?>