<?php
/*
 * 把含範圍行碼的坐標擴充成坐標列陣。
 * 〚0013:1:5-6〛 => 〚6093:5〛,〚6093:6〛
 */
use Dufu\Exceptions\InvalidCoordinateException;

function 含範圍行碼完整坐標轉換成坐標列陣( string $坐標, bool $debug=false ): array
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
	$範圍_regex = '/:(\d+)-(\d+)/u';
	
	$r = preg_match_all( $範圍_regex, $坐標, $match );
	
	if( $r && sizeof( $match ) > 2 )
	{
		$first  = intval( $match[ 1 ][ 0 ] );
		$second = intval( $match[ 2 ][ 0 ] );
		$行碼s = range( $first, $second );

		foreach( $行碼s as $行碼 )
		{
			array_push( $temp,
				str_replace( $match[ 0 ][ 0 ],
				':' . $行碼, $坐標 ) );
		}
		
		return $temp;
	}
	return array( $坐標 );
}

function convert_complete_coords_with_scoped_line_to_array_of_coords( string $坐標, bool $debug=false ): array
{
	return 含範圍行碼完整坐標轉換成坐標列陣( $坐標, $debug );
}
?>