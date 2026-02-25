<?php
/*
 * Probably due to the recursive call,
 * the tree will not be modified, albeit &
 * must use a store to store the result
 * should not return a bool because the value is pushed
 */
function 基準正文樹加句號(
	array &$樹, 
	array &$store, 
	bool $加新行 = false, 
	bool $debug=false ) : void
{
	foreach( $樹 as $k => $v )
	{
		$size = sizeof( $樹 );
		
		if( is_string( $v ) && intval( $k ) == $size )
		{
 			$樹[ $size ] = 
				$樹[ $size ] . '。' .
				( $加新行 ? NL : '' );
			array_push( $store, implode( $樹 ) );
 		}
		elseif( is_array( $v ) )
		{
			array_push( $store, 基準正文樹加句號( $v, $store, $加新行 ) );
		}
	}
}

function base_text_tree_add_。(
	array &$樹, 
	array &$store, 
	bool $加新行 = false, 
	bool $debug=false ) : void
{
	基準正文樹加句號( $樹, $store, $加新行, $debug );
}
?>