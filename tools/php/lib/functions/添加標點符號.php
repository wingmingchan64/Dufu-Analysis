<?php
/*
 * sequence: 1. 夾注 2. 注釋（號碼在 。 之前；inline 在 。 之後）
 * 先加 。 再視乎號碼還是inline，prepend or postpend
 */
function add_punctuation( 
	array &$tree, string $punc='。' ) : void
{
	if( is_string( $tree[ array_key_last( $tree ) ] ) )
	{
		$tree = $tree + 
			array( 'p' => $punc )
			+ array( 'a' => '' );
		return;
	}
	elseif( is_array( $tree[ array_key_last( $tree ) ] ) )
	{
		foreach( $tree as $key => $value )
		{
			// skip 詩題, etc.
			if( is_array( $tree[ $key ] ) )
			{
				add_punctuation( $tree[ $key ], $punc );
			}
		}
	}
}

function 添加標點符號( 
	array &$tree, string $punc='。' ) : void
{
	add_punctuation( $tree, $punc );
}
?>