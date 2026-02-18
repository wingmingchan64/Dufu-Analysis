<?php
/*
 * this function consults the complete list
 * calls 是完整坐標
 * no exception thrown
 */ 
function 是合法完整坐標( string $坐標 ) : bool
{
	if( !是完整坐標( $坐標 ) )
	{
		return false;
	}
	
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	$完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );
	
	return in_array( $坐標, $完整坐標表[ $文檔碼 ] );
}
?>