<?php
function add_node(
	array &$tree, // the canonical text tree
	array $path,  // path to the parent node; empty array means root
	int $pos,     // 0-based position to insert node
	array $node   // exactly one child node to insert
) : void
{
	if( count( $node ) !== 1 )
	{
		throw new InvalidArgumentException(
			'Parameter $node must contain exactly one child node.'
		);
	}

	$pointer = &$tree;

	// navigate to the parent node
	foreach( $path as $segment )
	{
		if( !is_array( $pointer ) )
		{
			throw new InvalidArgumentException(
				'Invalid path: encountered a non-array node before reaching target parent.'
			);
		}

		if(!array_key_exists( $segment, $pointer ) )
		{
			throw new InvalidArgumentException(
				'Invalid path: segment "' . (string)$segment . '" does not exist.'
			);
		}

		$pointer = &$pointer[ $segment ];
	}

	if( !is_array( $pointer ) )
	{
		throw new InvalidArgumentException(
			'Target parent node must be an array.'
		);
	}

	$child_count = count( $pointer );

	if( $pos < 0 || $pos > $child_count )
	{
		throw new OutOfRangeException(
			'Parameter $pos is out of range.'
		);
	}

	$new_key = array_key_first( $node );

	if( $new_key === null )
	{
		throw new InvalidArgumentException(
			'Parameter $node must not be empty.'
		);
	}

	if( array_key_exists( $new_key, $pointer ) )
	{
		throw new InvalidArgumentException(
			'Duplicate child key "' . (string)$new_key . '".'
		);
	}

	$before = array_slice( $pointer, 0, $pos, true );
	$after  = array_slice( $pointer, $pos, null, true );

	$pointer = $before + $node + $after;
}

function 添加節點(
	array &$tree, // the canonical text tree
	array $path,  // path to the parent node; empty array means root
	int $pos,     // 0-based position to insert node
	array $node   // exactly one child node to insert
) : void

{
	add_node( $tree, $path, $pos, $node );
}
?>