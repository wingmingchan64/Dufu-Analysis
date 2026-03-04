<?php
/*
 *
 */
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidCoordinateException;

function 是默認詩碼( string $碼, bool $debug=false ) : bool
{
	if( strpos( $碼, '-' ) !== false )
	{
		$碼 = str_replace( '-', ':', $碼 );
	}
	
	$碼 = '〚' . $碼 . ':〛';

	return 是默認詩碼坐標( $碼 );
}

function is_canonical_poem_id( string $碼, bool $debug=false ) : bool
{
	return 是默認詩碼( $碼, $debug );
}
?>