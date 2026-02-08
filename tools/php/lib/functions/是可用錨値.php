<?php
/*
 *
 */
function 是可用錨値( string $文檔碼, string $str ) : bool
{
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
	$默認詩文檔碼_詩文 = 提取數據結構( 默認詩文檔碼_詩文 );

	//
	if( !是文檔碼( $文檔碼 ) || !是合法錨値( $str ) )
	{
		return false;
	}
	
	if( in_array( $文檔碼, $默認詩文檔碼 ) )
	{
		$詩文 = $默認詩文檔碼_詩文[ $文檔碼 ];
		
		if( mb_strpos( $詩文, $str ) === false )
		{
			return false;
		}
		
		else
		{
			if( 在詩文重見名單中( $文檔碼, $str ) )
			{
				return false;
			}
			return true;
		}
	}
	return false;
}
?>