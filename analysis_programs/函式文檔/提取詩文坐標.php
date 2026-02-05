<?php
/*
 *
 */
function 提取詩文坐標( string $文檔碼, string $詩文 ) : string
{
	$result = array();
	$字數 = mb_strlen( $詩文 );
	$文_標s = 提取數據結構( 數字對照陣列[ $字數 ] );
	$標s = $文_標s[ $詩文 ];
	if( sizeof( $標s ) > 1 )
	{
		foreach( $標s as $標 )
		{
			$碼 = mb_substr( $標, 1, 4 );
			if( $碼 == $文檔碼 )
			{
				array_push( $result, $標 );
			}
		}
	}
	if( sizeof( $result ) == 1 )
	{
		return $result[ 0 ];
	}
	else
	{
		return "找不到。";
	}
}
?>