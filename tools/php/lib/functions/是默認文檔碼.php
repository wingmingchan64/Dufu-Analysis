<?php
/*
 *
 */
function 是默認文檔碼( string $str ) : bool
{
	$str = fix_doc_id( $str );
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
	return in_array( $str, $默認詩文檔碼 );
}
?>