<?php
/*
 * 提取文檔碼，〚 後面的四個數字。
 * called by 是合法完整坐標，因此不檢查坐標是否合法。
 */
function 提取文檔碼( string $坐標, bool $debug=false ) : string
{
	if( 是完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "「${坐標}」不是完整坐標。" );
	}

	return mb_substr( $坐標, 1, 4 );
}

function get_doc_id( string $坐標, bool $debug=false ) : string
{
	return 提取文檔碼( $坐標 );
}
?>