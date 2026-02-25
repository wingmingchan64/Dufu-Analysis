<?php
/*
 * $坐標 必須是完整坐標。
 */
function 含首碼( string $坐標, bool $debug=false ) : bool
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

	return 是組詩( $文檔碼 );
}

function contain_member_poem_id( string $坐標, bool $debug=false ) : bool
{
	return 含首碼( $坐標, $debug );
}
?>