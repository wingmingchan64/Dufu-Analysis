<?php
/*
 *
 */
function 是含範圍字碼完整坐標( string $坐標 ) : bool
{
	$含範圍字碼完整坐標 = 提取數據結構( 含範圍字碼完整坐標 );

	return array_key_exists( $坐標, $含範圍字碼完整坐標 );
}
?>