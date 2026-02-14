<?php
/*
 *
 */
function 是詩碼坐標( string $坐標 ) : bool
{
	$詩碼坐標 = 提取數據結構( 詩碼坐標 );

	return in_array( $坐標, $詩碼坐標 );
}
?>