<?php
/*
 * 沿著路徑，於末端插入文字。
 */
 use Dufu\Exceptions\InvalidPathException;

function 插入路徑字( 
	array &$陣列, array $路徑, string $字='', bool $debug=false ) : bool
{
	$pointer = &$陣列;
	
	foreach( $路徑 as $step )
	{
		$pointer = &$pointer[ $step ];
	}
	
	$pointer = $pointer . $字;
	return true;
}

function insert_text_by_path(
	array &$陣列, array $路徑, string $字='', bool $debug=false ) : bool
{
	return 插入路徑字( $陣列, $路徑, $開始, $字, $debug );
}
?>