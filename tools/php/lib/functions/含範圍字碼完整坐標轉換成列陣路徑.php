<?php
/*
 * 
 */
function 含範圍字碼完整坐標轉換成列陣路徑( string $坐標 ): array
{
	$temp = array();
	$result = array();
	$match = array();
	$範圍_regex = '/\.([\d+])-([\d+])/u';
	
	$r = preg_match_all( $範圍_regex, "〚0276:20.2.2-4〛",
		$match );
	if( $r && sizeof( $match ) > 2 )
	{
		//print_r( $match );
		$字碼s = range( 
			intval( $match[ 1 ][ 0 ] ), 
			intval( $match[ 2 ][ 0 ] ) );
		foreach( $字碼s as $字碼 )
		{
			array_push( $temp,
				str_replace( $match[ 0 ][ 0 ],
				'.' . $字碼, $坐標 ) );
		}
	}
	return $temp;
}

function convert_complete_coords_with_scoped_char_to_array_path( string $坐標 ): array
{
	return 含範圍字碼完整坐標轉換成列陣路徑( $坐標 );
}
?>