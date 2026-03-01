<?php
/*
 * 沿著路徑，提取末端的文字。
 */
function 提取路徑字(
	array $陣列, array $路徑, int $開始=0, bool $debug=false ) : string
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		return $陣列[ $路徑[ $開始 ] ];
	}
	else
	{
		return 提取路徑字( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1, $debug );
	}
}

function get_char_by_path(
	array $陣列, array $路徑, int $開始=0, bool $debug=false ) : string
{
	return 提取路徑字( $陣列, $路徑, $開始, $debug );
}
?>