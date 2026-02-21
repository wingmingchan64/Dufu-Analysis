<?php
/*
 * 〚0013:〛 true
 * 〚0013:1:〛 false
 */
function 只有文檔碼之完整坐標( string $坐標 ) : bool
{
	if( 是合法完整坐標( $坐標 ) === false )
	{
		throw new InvalidCoordinateException( "不是合法完整坐標。" );
	}
	
	return ( mb_strlen( trim( $坐標 ) ) == 7 );
}

function is_complete_coords_with_only_doc_id( string $坐標 ) : bool
{
	return 只有詩碼之完整坐標( $坐標 );
}
?>