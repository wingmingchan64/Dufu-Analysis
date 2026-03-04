<?php
/*
 *
 */
function 是默認詩碼坐標( string $坐標, bool $debug=false ) : bool
{
	$默認詩碼坐標 = 提取數據結構( 默認詩碼坐標 );

	return in_array( $坐標, $默認詩碼坐標 );
}

function is_canonical_poem_id_coords( string $坐標, bool $debug=false ) : bool
{
	return 是默認詩碼坐標( $坐標, $debug );
}
?>