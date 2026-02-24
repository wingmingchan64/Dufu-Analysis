<?php
/*
 * 
 */
function 基準正文樹加句號(
	array &$樹, array &$store, bool $加新行 = false ) 
{
	foreach( $樹 as $k => $v )
	{
		$size = sizeof( $樹 );
		
		if( is_string( $v ) && intval( $k ) == $size )
		{
 			$樹[ $size ] = 
				$樹[ $size ] . '。' .
				( $加新行 ? NL : '' );
			//array_push( $store, implode( $樹 ) );
 		}
		
		elseif( is_array( $v ) )
		{
			基準正文樹加句號( $v, $store, $加新行 );
			//array_push( $store, 基準正文樹加句號( $v, $store, $加新行 ) );
		}
	}
}
?>