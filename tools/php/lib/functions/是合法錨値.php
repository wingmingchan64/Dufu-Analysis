<?php
/*
 *
 */
function 是合法錨値( string $str ) : bool
{
	$完整坐標表 = 提取數據結構( 完整坐標表 );
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );
	$str = fix_text( $str );
	
	// not 坐標, 詩文
	if( 
		!in_array( $str, $完整坐標表 ) &&
		!in_array( $str, $非完整坐標表 ) &&
		!in_array( $str, $詩文組合 ) )
		{
			return false;
		}
		
	return true;
}
?>