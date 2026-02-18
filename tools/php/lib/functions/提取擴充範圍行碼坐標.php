<?php
/*
 * given 〚0013:1:5-6〛, returns array containing
 * 〚0013:1:5〛,〚0013:1:6〛
 * 只接受完整坐標，只擴充行碼
 */
function 提取擴充範圍行碼坐標( string $坐標 ) : array
{
	if( 是完整坐標( $坐標 ) === false )
	{
		throw new IncompleteCoordinateException( "不是完整坐標。" );
	}
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	$是組詩 = 是組詩( $文檔碼 );
	
	if( $是組詩 )
	{
		$regex = '/\d{4}:\d+:\d+-\d+/u'; // 〚0013:2:11-13〛
	}
	else
	{
		$regex = '/\d{4}:\d+-\d+/u'; // 〚0003:5.1-4〛
	}
	$裸坐標 = str_replace( '〚', '', 
		str_replace( '〛', '', $坐標 ) );
	$match = array();
	
	$r = preg_match( $regex, $裸坐標, $match );
	
	if( !$r || $match[ 0 ] != $裸坐標 )
	{
		$match = array();
		//echo "Should be here 100", NL;
		if( !$r || $match[ 0 ] != $裸坐標 )
		{
			return array( "字碼沒有範圍數字。" );
		}
		echo "Should be here 101", NL;
	}
	// $parts[2], the last part
	$parts = explode( ':', $裸坐標 );
	$size = sizeof( $parts );
	$last = $parts[ $size - 1 ];
	if( $是組詩 )
	{
		$first = $parts[ 0 ] . ':' . $parts[ 1 ] . ':';
	}
	else
	{
		$first = $parts[ 0 ] . ':';
	}
	//echo "First: ", $first, NL;
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

function get_coords_with_line_scope( string $坐標 ) : array
{
	return 提取擴充範圍行碼坐標( $坐標 );
}
?>