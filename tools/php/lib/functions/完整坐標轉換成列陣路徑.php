<?php
/*
 * 
 */
// 完整坐標中，其中不能有範圍 - 
function 完整坐標轉換成列陣路徑( string $坐標 ) : array
{
	// remove brackets
	$坐標 = str_replace( 坐標開括號, '', 
			str_replace( 坐標關括號, '', $坐標 ) );
	// hyphen only
	$坐標 = str_replace( ':', '-', $坐標 );
	$坐標 = str_replace( '.', '-', $坐標 );
	
	return explode( '-', trim( $坐標, ' -' ) );
}

function convert_complete_coords_to_array_path( string $坐標 ) : array
{
	return 完整坐標轉換成列陣路徑( $坐標 );
}
?>