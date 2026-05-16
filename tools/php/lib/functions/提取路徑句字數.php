<?php
/*
 * 0003,3,1
 */
use Dufu\Exceptions\InvalidPathException;

function 提取路徑句字數( string $path ) : int
{
	$路徑_句 = 提取數據結構( 路徑_句 );

	if( !array_key_exists( $path, $路徑_句 ) )
	{
		throw new InvalidPathException( 
			"「${path}」不存在。" );
	}
	return mb_strlen( $路徑_句[ $path ] );
}
?>