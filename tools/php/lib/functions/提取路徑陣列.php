<?php
/*
 * 
 */
function 提取路徑陣列( array $陣列, array $路徑, int $開始=0 ) : array
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		return $陣列[ $路徑[ $開始 ] ];
	}
	else
	{
		return 提取路徑陣列( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1 );
	}
}
?>