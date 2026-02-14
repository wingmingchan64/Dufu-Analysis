<?php
/*
 *
 */
function 提取詩文坐標( string $文檔碼, string $詩文 ) : mixed
{
	$詩文_坐標 = 提取數據結構( 默認詩文檔碼_詩文_坐標 );
	
	if( array_key_exists( $詩文, $詩文_坐標[ $文檔碼 ] ) )
	{
		$result = $詩文_坐標[ $文檔碼 ][ $詩文 ];
		
		if( is_array( $result ) )
		{
			if( sizeof( $result ) == 1 )
			{
				return $result[ 0 ]; // string
			}
			else
			{
				return $result; // array
			}
		}
		return "「${詩文}」不合法。";
	}
	return "「${詩文}」不合法。";
}
?>