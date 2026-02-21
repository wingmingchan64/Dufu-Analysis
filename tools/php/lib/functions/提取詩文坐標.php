<?php
/*
 *
 */
function 提取詩文坐標( string $詩文 ) : array
{
	$字數 = mb_strlen( $詩文 );
	$結構 = 提取數據結構( 數字對照陣列[ $字數 ] );
	
	if( array_key_exists( $詩文, $結構 ) )
	{
		return $結構[ $詩文 ];
	}
	throw new InvalidPoemFragmentException(
		"杜甫詩中無「${詩文}」。" );
}
 

function 提取文檔碼詩文坐標( string $文檔碼, string $詩文 ) : array
{
	if( !是默認文檔碼( $文檔碼 ) )
	{
		throw new InvalidDocumentIDException(
			"文檔碼「${文檔碼}」不存在。"
		);
	}
		
	$坐標s = 提取詩文坐標( $詩文 );
	$result = array();
	
	foreach( $坐標s as $坐標 )
	{
		if( 提取文檔碼( $坐標 ) == $文檔碼 )
		{
			array_push( $result, $坐標 );
		}
	}
	
	return $result;
}


?>