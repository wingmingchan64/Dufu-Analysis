<?php
/*
 * 
 */
function 提取路徑字( array $陣列, array $路徑, int $開始 ) : string
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		return $陣列[ $路徑[ $開始 ] ];
	}
	else
	{
		return 提取路徑字( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1 );
	}
}






function 替換路徑字( array &$陣列, array $路徑, int $開始, $字 ) : bool
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		$陣列[ $路徑[ $開始 ] ] = $字;
		return true;
	}
	else
	{
		return 替換路徑字( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1, $字 );
	}
}

function 插入路徑字( array &$陣列, array $路徑, int $開始, $字 ) : bool
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		$陣列[ $路徑[ $開始 ] ] = $陣列[ $路徑[ $開始 ] ] . $字;
		return true;
	}
	else
	{
		return 插入路徑字( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1, $字 );
	}
}


?>