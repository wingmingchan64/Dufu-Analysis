<?php
function 是合法完整坐標( string $str ) : bool
{
	$完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );
	$文檔碼 = 提取頁碼( $str );
	
	if( !array_key_exists( $文檔碼, $完整坐標表 ) )
	{
		return false;
	}
	if( !in_array( $str, $完整坐標表[ $文檔碼 ] ) )
	{
		return false;
	}
	return true;
}
?>