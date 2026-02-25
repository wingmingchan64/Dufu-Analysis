<?php
/*
 * 
 */
function 基準正文樹深度優先遍歷( array $樹, array &$store ) 
{
	foreach( $樹 as $k => $v )
	{
		if( is_string( $v ) && intval( $k ) == 1 )
		{
 			array_push( $store, implode( $樹 ) );
 		}
		elseif( is_array( $v ) )
		{
			array_push( $store, 基準正文樹深度優先遍歷( $v, $store ) );
		}
	}
}

?>