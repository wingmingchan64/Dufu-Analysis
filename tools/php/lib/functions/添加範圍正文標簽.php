<?php
/*
 * 
 */
function add_tag_to_scope(
	array &$tree,
	string $scope,
	string $open_tag = '《',
	string $close_tag = '》'
) : void
{
	$parts = explode( ',', $scope );

	// make sure it is a complete path
	if( count( $parts ) < 4 )
	{
		throw new InvalidArgumentException( 'Invalid scope.' );
	}

	// find the scope: start and end
	$last = array_pop( $parts );

	if( str_contains( $last, '-' ) )
	{
		[ $start, $end ] = explode( '-', $last, 2 );
	}
	else
	{
		$start = $last;
		$end = $last;
	}

	// navigate to the scoped text
	$pointer = &$tree;

	foreach( $parts as $key )
	{
		if( !is_array( $pointer ) || !array_key_exists( $key, $pointer ) )
		{
			throw new InvalidArgumentException( 'Invalid path in scope.' );
		}

		$pointer = &$pointer[ $key ];
	}

	if( !array_key_exists( $start, $pointer ) || !array_key_exists( $end, $pointer ) )
	{
		throw new InvalidArgumentException( 'Invalid start or end key in scope.' );
	}

	// add start and end tag
	$pointer[ $start ] = $open_tag . $pointer[ $start ];
	$pointer[ $end ] = $pointer[ $end ] . $close_tag;
}

function 添加範圍正文標簽(
	array &$tree,
	string $scope,
	string $open_tag,
	string $close_tag
) : void
{
	add_tag_to_scope( $tree, $scope, $open_tag, $close_tag );
}


?>