<?php
/*
 * 視乎 $bool 的布爾値，顯示 'true' 或 'false'。
 */
function 清理JSON括號(
	string $json, bool $remove_quotes = false ) : string
{
	$json = preg_replace( '/{/', '', $json );
	$json = preg_replace( '/\s+}/', '', $json );
	$json = str_replace( ',', '', $json );
	$json = preg_replace( '/\[/', '', $json );
	$json = preg_replace( '/\s+\]/', '', $json );
	
	if( $remove_quotes )
	{
		$json = str_replace( '"', '', $json );
	}
	return $json;
}
?>