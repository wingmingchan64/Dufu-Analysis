<?php
/*
 *
 */
function 是合法錨値( string $str ) : bool
{
	$str = fix_text( $str );
	$默認詩文檔碼_完整坐標表 = 
		提取數據結構( 默認詩文檔碼_完整坐標表 );
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );

	if( 是完整坐標( $str ) )
	{
		$默文檔碼 = mb_substr( $str, 1, 4 );
		
		if( in_array( $默文檔碼, $默認詩文檔碼_完整坐標表 ) )
		{
			return true;
		}
	}
	
	// not 坐標, 詩文
	elseif( 
		!in_array( $str, $非完整坐標表 ) &&
		!in_array( $str, $詩文組合 ) )
	{
		return false;
	}
		
	return true;
}
?>