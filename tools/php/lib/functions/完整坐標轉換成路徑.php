<?php
/*
 * 〚6093:5.2.3〛returns '6093,5,2,3';
 */
use Dufu\Exceptions\InvalidCoordinateException;

// 完整坐標中，其中不能有範圍 - 
function 完整坐標轉換成路徑( 
	string $坐標, 
	bool $allow_hyphen = false,
	bool $debug=false ) : string
{
	//echo $坐標, NL;
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
	
	if( !$allow_hyphen )
	{
		if( mb_strpos( $坐標, '-' ) !== false )
		{
			throw new InvalidCoordinateException(
				"坐標「${坐標}」不能有「-」。"
			);
		}
	}
	// remove brackets
	$坐標 = str_replace( 坐標開括號, '', 
		str_replace( 坐標關括號, '', $坐標 ) );
	// hyphen only
	$坐標 = str_replace( ':', ',', $坐標 );
	$坐標 = str_replace( '.', ',', $坐標 );
	$坐標 = rtrim( $坐標, ',' ); // remove last ,
	
	return $坐標;
}

function convert_complete_coords_to_path( 
	string $坐標, 
	bool $allow_hyphen = false,
	bool $debug=false ) : string
{
	return 完整坐標轉換成路徑列陣( $坐標, $allow_hyphen, $debug );
}
?>