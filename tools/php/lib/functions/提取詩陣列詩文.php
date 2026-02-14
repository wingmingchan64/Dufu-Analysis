<?php
/*
 * 
 */

function 提取詩陣列詩文(
	array $詩陣列,
	array &$store,
	bool $加句號 = true,
	bool $加新行 = true ) : bool
{
	foreach( $詩陣列 as $index => $子 )
	{
		if( intval( $index ) > 0 && is_string( $子 ) )
		{
			array_push( $store, $子 );
			
			if( intval( $index ) == 
				sizeof( $詩陣列 ) )
			{
				if( $加句號 )
				{
					array_push( $store, '。' );
				}
				if( $加新行 )
				{
					array_push( $store, NL );
				}
			}
		}
		elseif( intval( $index ) > 0 && is_array( $子 ) )
		{
			提取詩陣列詩文( $子, $store, $加句號, $加新行 );
		}
	}

	return true;
}
?>