<?php
/*
 * 
 */
function 提取樹行路徑( array &$tree ) : array
{
	$paths = array();
	$root_key = array_keys( $tree )[ 0 ];
	$root = $tree[ $root_key ];
	$root_str = $root_key . ',';
	
	if( 是組詩( $root_key ) )
	{
		$root = $tree[ $root_key ];
		$root_key = array_keys( $root )[ 0 ];
		$root = $root[ $root_key ];
		$root_str .= $root_key . ',';
	}
	foreach( $root as $k => $v )
	{
		if( intval( $k ) )
		{
			$paths[] = $root_str . $k;
		}
	}
	
	return $paths;
}

function get_tree_line_paths( array &$tree ) : array
{
	return 提取樹行路徑( $tree );
}
?>