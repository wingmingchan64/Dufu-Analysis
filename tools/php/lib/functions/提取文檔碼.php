<?php
/*
 * 提取文檔碼，〚 後面的四個數字。
 * called by 是合法完整坐標
 */
function 提取文檔碼( string $坐標 ) : string
{
	if( 是完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是完整坐標。" );
	}

	return mb_substr( $坐標, 1, 4 );
}

function get_doc_id( string $坐標 ) : string
{
	return 提取文檔碼( $坐標 );
}
?>