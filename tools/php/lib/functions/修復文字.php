<?php
/*
 * 把文字規範化。
 */
function 修復文字( string $str ) : string
{
	return fix_text( $str );
}

function fix_text( string $str ) : string
{
	$異體字 = 提取數據結構( REGISTRY_DIR . '異體字' );
	$len = mb_strlen( $str );
	$temp = '';
	$ytz = array_keys( $異體字 );
	
	foreach( range( 0, $len - 1 ) as $pos )
	{
		$字 = mb_substr( $str, $pos, 1 );
		
		if( in_array( $字, $ytz ) )
		{
			$temp .= $異體字[ $字 ];
		}
		else
		{
			$temp .= $字;
		}
	}
	return $temp;
}
?>