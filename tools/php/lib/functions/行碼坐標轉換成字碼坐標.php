<?php
/*
 * 把只有行碼的完整坐標擴充爲該行最後一字的完整坐標。
 * 〚0003:5〛 => 〚0003:5.2.5〛
 * 〚0229:4〛 => 〚0229:4.1.7〛
 * 〚0013:1:7〛 => 〚0013:1:7.2.7〛
 */
function 行碼坐標轉換成字碼坐標( string $坐標 ) : string
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
		$無尾坐標 = rtrim( $坐標, '〛' );
		$末句碼 = 0;
		$末句標 = '';
		$末字碼 = 0;
		
		foreach( $完整坐標表 as $標 )
		{
			// 只看同一行的坐標
			if( mb_strpos( $標, $無尾坐標 ) !== false )
			{
				if( 有字碼之完整坐標( $標 ) )
				{
					$句碼 = 提取句碼( $標 );
					// 找最後一句
					if( intval( $句碼 ) >= intval( $末句碼 ) )
					{
						$末句碼 = $句碼;
						$字碼 = 提取字碼( $標 );
						// 找該句最後一字
						if( intval( $字碼 ) > intval( $末字碼 ) )
						{
							$末字碼 = $字碼;
						}
					}
				}
			}
		}
		return $無尾坐標 . '.' .
			$末句碼 . '.' . $末字碼 . '〛';
	}
	catch( RuntimeException $e )
	{
		throw new InvalidCoordinateException(
			"坐標「${坐標}」不存在。"
		);
	}
}

function convert_coords_with_line_id_to_coords_with_char_id( 
	string $坐標 ) : string
{
	return 行碼坐標轉換成字碼坐標( $坐標 );
}

?>