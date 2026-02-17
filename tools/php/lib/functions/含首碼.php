<?php
/*
 * $坐標 必須是完整坐標。
 */
function 含首碼( string $坐標 ) : bool
{
	if( 是完整坐標( $坐標 ) === false )
	{
		throw new IncompleteCoordinateException( "不是完整坐標。" );
	}
	$文檔碼 = 提取文檔碼( $坐標 );
	return 是組詩( $文檔碼 );
}
?>