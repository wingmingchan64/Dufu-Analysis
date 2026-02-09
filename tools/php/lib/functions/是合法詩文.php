<?php
/*
 *
 */
function 是合法詩文( string $詩文 ) : bool
{
	$詩文 = fixText( $詩文 );
	$詩文組合 = 提取數據結構( 詩文組合 );

	return in_array( $詩文, $詩文組合 );
}
?>