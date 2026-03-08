<?php
/*
 * 沿著路徑，替換末端的文字。
 */
use Dufu\Exceptions\InvalidPathException;

function 替換路徑字(
	array &$陣列, array $路徑, string $字='', bool $debug=false ) : bool
{
	$pointer = &$陣列;
	
	foreach( $路徑 as $step )
	{
		$pointer = &$pointer[ $step ];
	}
	
	$pointer = $字;
	return true;
}

function replace_text_by_path(
	array &$陣列, array $路徑, string $字='', bool $debug=false ) : bool
{
	return 替換路徑字( $陣列, $路徑, $字, $debug );
}
?>