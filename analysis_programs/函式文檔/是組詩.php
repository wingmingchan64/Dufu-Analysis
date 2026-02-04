<?php
/*
 *
 */
function 是組詩( string $文檔碼 ) : bool
{
	$組詩 = 提取數據結構( 組詩_副題 );

	return array_key_exists( $文檔碼, $組詩 );
}
?>