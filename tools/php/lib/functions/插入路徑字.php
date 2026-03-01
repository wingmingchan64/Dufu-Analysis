<?php
/*
 * 沿著路徑，於末端插入文字。
 */
function 插入路徑字( array &$陣列, array $路徑, int $開始=0, $字='', bool $debug=false ) : bool
{
	if( $開始 == sizeof( $路徑 ) - 1 )
	{
		$陣列[ $路徑[ $開始 ] ] = $陣列[ $路徑[ $開始 ] ] . $字;
		return true;
	}
	else
	{
		return 插入路徑字( $陣列[ $路徑[ $開始 ] ], $路徑, $開始+1, $字, $debug );
	}
}

function insert_text_by_path( array &$陣列, array $路徑, int $開始=0, $字='', bool $debug=false ) : bool
{
	return 插入路徑字( $陣列, $路徑, $開始, $字, $debug );
}
?>