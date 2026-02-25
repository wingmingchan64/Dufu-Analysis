<?php
/*
 * 
 */
function 含範圍字碼完整坐標轉換成路徑列陣( string $坐標, bool $debug=false ): array
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
	$result = array();
	$match = array();
	$範圍_regex = '/\.([\d+])-([\d+])/u';
	
	$r = preg_match_all( $範圍_regex, $坐標, $match );
	
	if( $r && sizeof( $match ) > 2 )
	{
		$first  = intval( $match[ 1 ][ 0 ] );
		$second = intval( $match[ 2 ][ 0 ] );
		$字碼s = range( 
			intval( $match[ 1 ][ 0 ] ), 
			intval( $match[ 2 ][ 0 ] ) );

		foreach( $字碼s as $字碼 )
		{
			array_push( $temp,
				str_replace( $match[ 0 ][ 0 ],
				'.' . $字碼, $坐標 ) );
		}
		
		foreach( $temp as $坐標 )
		{
			array_push( $result,
				完整坐標轉換成路徑列陣( $坐標 ) );
		}
	}
	return $result;
}

function convert_complete_coords_with_scoped_char_to_path_array( string $坐標, bool $debug=false ): array
{
	return 含範圍字碼完整坐標轉換成路徑列陣( $坐標, $debug );
}
?>