<?php
/*
 * uses 插入路徑文字
 */
function 插入詩陣列文字( 
	array &$詩陣列, string $坐標, string $文字 ) : bool
{
	return 插入首陣列文字( $詩陣列, $坐標, $文字 );
}

function 插入首陣列文字( array &$詩陣列, string $坐標, string $文字 ) : bool
{
	if( 是含範圍字碼完整坐標( $坐標 ) )
	{
		$路徑陣列s = 含範圍字碼完整坐標轉換成路徑列陣( $坐標 );
	}
	else
	{
		$路徑陣列s = array( 完整坐標轉換成路徑列陣( $坐標 ) );
	}
	
	$size = sizeof( $路徑陣列s );
	
	for( $i = 0; $i < $size - 2; $i++ )
	{
		插入路徑文字( $詩陣列, $路徑陣列s[ $i ], 空語鏈 );
	}
	
	插入路徑文字( $詩陣列, $路徑陣列s[ $size - 1 ], $文字 );
	
	return true;
}
?>