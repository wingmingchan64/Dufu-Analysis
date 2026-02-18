<?php
/*
 *
 */
function 是含範圍行碼完整坐標( string $坐標 ) : bool
{
	$含範圍行碼完整坐標 = 提取數據結構( 含範圍行碼完整坐標 );

	return in_array( $坐標, $含範圍行碼完整坐標 );
}
?>