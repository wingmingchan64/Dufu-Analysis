<?php
/*
 *
 */
function 是默認版本詩碼( string $str ) : bool
{
	$str = fixDocID( $str );
	$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
	return in_array( $str, $默認版本詩碼 );
}
?>