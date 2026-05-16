<?php
/*
 * 
 */
function 添加末端錨( array &$tree ) : void
{
	foreach( $tree as $k => $v )
	{
		if( is_string( $v ) && $v != '')
		{
			$tree[ $k ] = array( $k => $v, 樹錨名 => '' );
		}
		else
		{
			添加末端錨( $tree[ $k ] );
		}
	}
}
?>