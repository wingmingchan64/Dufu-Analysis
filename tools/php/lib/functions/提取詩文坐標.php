<?php
/*
 *
 */
function 提取詩文坐標( string $文檔碼, string $詩文 ) : mixed
{
	//$默文檔碼 = 提取數據結構( 默認詩文檔碼 );
	$詩文_坐標 = 提取數據結構( 默認詩文檔碼_詩文_坐標 );
	
	if( !是文檔碼( $文檔碼 ) )
	{
		return "「${文檔碼}」不合法。";
	}
	if( array_key_exists( $詩文, $詩文_坐標[ $文檔碼 ] ) )
	{
		$result = $詩文_坐標[ $文檔碼 ][ $詩文 ];
		if( sizeof( $result ) == 1 )
		{
			return $result[ 0 ];
		}
		else
		{
			return $result;
		}
		
	}
	return "「${詩文}」不合法。";
}
?>