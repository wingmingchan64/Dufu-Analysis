<?php
/**
 * 攤平樹為文字，可略過指定 key。
 *
 * @param mixed $node
 * @param array $skip_keys
 * @return string
 * @throws InvalidArgumentException
 */
function flatten_tree_to_text_skip_keys(
	mixed $node, array $skip_keys = [] ): string
{
	if( is_string( $node ) )
	{
		return $node;
	}

	if(!is_array($node))
	{
		throw new InvalidArgumentException(
			'Tree node must be either string or array.'
		);
	}

	$text = '';

	foreach( $node as $key => $child )
	{
		if( in_array( ( string )$key, $skip_keys, true ) )
		{
			continue;
		}

		$text .= flatten_tree_to_text_skip_keys($child, $skip_keys);
	}

	return $text;
}

function 攤平樹文字_略過鍵(
	mixed $node, array $skip_keys = [] ): string
{
	return flatten_tree_to_text_skip_keys( $node, $skip_keys );
}
?>