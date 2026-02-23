<?php
/*
 * 把含範圍字碼的坐標擴充成坐標列陣。
 * 〚6093:5.2.2-3〛 => 〚6093:5.2.2〛,〚6093:5.2.3〛
 */
function 含範圍字碼完整坐標轉換成坐標列陣( string $坐標 ): array
{
	$文檔碼 = mb_substr( $坐標, 1, 4 );
	
	try
	{
		$完整坐標表 = 提取數據結構( 完整坐標表文件夾 . $文檔碼 );
		
		if( !in_array( $坐標, $完整坐標表 ) )
		{
			throw new InvalidCoordinateException(
				"坐標「${坐標}」不存在。"
			);
		}
	}
	catch( RuntimeException $e )
	{
		throw new InvalidCoordinateException(
			"坐標「${坐標}」不存在。"
		);
	}
	
	$temp = array();
	$match = array();
	$範圍_regex = '/\.([\d+])-([\d+])/u';
	
	$r = preg_match_all( $範圍_regex, $坐標, $match );
	
	if( $r && sizeof( $match ) > 2 )
	{
		$first  = intval( $match[ 1 ][ 0 ] );
		$second = intval( $match[ 2 ][ 0 ] );
		$字碼s = range( $first, $second );

		foreach( $字碼s as $字碼 )
		{
			array_push( $temp,
				str_replace( $match[ 0 ][ 0 ],
				'.' . $字碼, $坐標 ) );
		}
		
		return $temp;
	}
	return array( $坐標 );
}

function convert_complete_coords_with_scoped_char_to_array_of_coords( string $坐標 ): array
{
	return 含範圍字碼完整坐標轉換成坐標列陣( $坐標 );
}
?>