<?php
function 是合法完整坐標( array $坐標陣列, string $str ) : bool
{
	$文檔碼 = 提取頁碼( $str );
	
	if( !array_key_exists( $文檔碼, $坐標陣列 ) )
	{
		return false;
	}
	if( !in_array( $str, $坐標陣列[ $文檔碼 ] ) )
	{
		return false;
	}
	return true;
}
?>