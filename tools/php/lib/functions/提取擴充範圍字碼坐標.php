<?php
/*
 * given 〚0013:1:5.2.3-4〛, returns array containing
 * 〚0013:1:5.2.3〛,〚0013:1:5.2.4〛
 * 只接受完整坐標，只擴充字碼
 */
function 提取擴充範圍字碼坐標( string $坐標, bool $debug=false ) : array
{
	if( 是完整坐標( $坐標 ) === false )
	{
		throw new IncompleteCoordinateException( "不是完整坐標。" );
	}
	$regex1 = '/\d{4}:\d+\.\d.\d+-\d+/u'; // 〚0003:5.1.2-4〛
	$regex2 = '/\d{4}:\d+:\d+\.\d.\d+-\d+/u'; // 〚0013:2:11.2.1-3〛
	$裸坐標 = str_replace( '〚', '', 
		str_replace( '〛', '', $坐標 ) );
	$match = array();
	
	$r = preg_match( $regex1, $裸坐標, $match );
	if( !$r || $match[ 0 ] != $裸坐標 )
	{
		$match = array();
		$r = preg_match( $regex2, $裸坐標, $match );
		if( !$r || $match[ 0 ] != $裸坐標 )
		{
			return array( "字碼沒有範圍數字。" );
		}
	}
	// $parts[2], the last part
	$parts = explode( '.', $裸坐標 );
	$last = $parts[ 2 ];
	$first = $parts[ 0 ] . '.' . $parts[ 1 ] . '.';
	
	$坐標陣列 = array();
	$pre_parts = "";
	$行範圍 = explode( '-', $last );
	
	if( intval( $行範圍[ 0 ] ) >= 
		intval( $行範圍[ 1 ] ) )
	{
		return array( "字碼範圍數字不合規範。" );
	}
	$字碼範圍陣列 = 
		range( intval( $行範圍[ 0 ] ), intval( $行範圍[ 1 ] ) );
	
	foreach( $字碼範圍陣列 as $字碼 )
	{
		array_push(
			$坐標陣列,
			'〚' . $first . $字碼 . '〛' );
	}
			
	return $坐標陣列;
}


function get_coords_with_char_scope( string $坐標, bool $debug=false ) : array
{
	return 提取擴充範圍字碼坐標( $坐標, $debug );
}
?>