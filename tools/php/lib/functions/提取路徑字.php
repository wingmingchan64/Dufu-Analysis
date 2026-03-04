<?php
/*
 * 沿著路徑，提取末端的文字。
 * due to recursive call, $陣列的內容會改變，所以要 $pointer。
 */
use Dufu\Exceptions\InvalidPathException;

function 提取路徑字(
	array $陣列, array $路徑, int $開始=0, bool $debug=false ) : string
{
	$pointer = $陣列;
	
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		if( array_key_exists( 
			$路徑[ $開始 ], $pointer ) )
		{
			return $pointer[ $路徑[ $開始 ] ];
		}
		else
		{
			throw new InvalidPathException(
				"路徑不存在。"
			);
		}
	}
	else
	{
		if( array_key_exists( 
			$路徑[ $開始 ], $pointer ) )
		{	
			return 提取路徑字(
				$pointer[ $路徑[ $開始 ] ], $路徑, $開始+1, $debug );
		}
		else
		{
			throw new InvalidPathException(
				"路徑不存在。"
			);
		}
	}
}

function get_char_by_path(
	array $陣列, array $路徑, int $開始=0, bool $debug=false ) : string
{
	return 提取路徑字( $陣列, $路徑, $開始, $debug );
}
?>