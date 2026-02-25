<?php
/*
 * 詩文若出現在此黑名單中，則不能用作錨値。
 */
function 在詩文重見名單中
	( string $文檔碼, string $詩文, bool $debug=false ) : bool
{
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
	$詩文重見名單 = 提取數據結構( 默認詩文檔碼_詩文重見名單 );
	
	if( !in_array( $文檔碼, $默認詩文檔碼 ) )
	{
		throw new InvalidDocumentIDException(
			"「${文檔碼}」不合法。"
		);
	}
	elseif( !array_key_exists( $文檔碼, $詩文重見名單 ) )
	{
		return false;
	}
	elseif( in_array( $詩文, $詩文重見名單[ $文檔碼 ] ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function is_in_list_of_repeated_fragment( string $文檔碼, string $詩文, bool $debug=false ) : bool
{
	return 在詩文重見名單中( $文檔碼, $詩文, $debug );
}
?>