<?php
/*
 * 沿著路徑，替換末端的文字。
 */
use Dufu\Exceptions\InvalidPathException;

function 替換路徑字(
	array &$陣列, array $路徑, int $開始=0, string $字='', bool $debug=false ) : bool
{
	try
	{
		$pointer = &$陣列;

		if( $開始 == sizeof( $路徑 ) - 1 )
		{
			$pointer[ $路徑[ $開始 ] ] = $字;
			return true;
		}
		else
		{
			return 替換路徑字(
				$pointer[ $路徑[ $開始 ] ], $路徑, $開始+1, $字, $debug );
		}
	}
	catch( Exception $e )
	{
		echo $e->getMessage();
	}
	catch( Error $e )
	{
		echo $e->getMessage();
	}
}

function replace_text_by_path(
	array &$陣列, array $路徑, int $開始=0, string $字='', bool $debug=false ) : bool
{
	return 替換路徑字( $陣列, $路徑, $開始, $字, $debug );
}
?>