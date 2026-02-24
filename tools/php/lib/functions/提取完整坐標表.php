<?php
/*
 * 提取與該文檔碼相應的完整坐標表。
 */
function 提取完整坐標表( string $文檔碼, bool $mode = false ) : array
{
	$文檔碼 = 修復文檔碼( $文檔碼 );
	debug_echo( __FILE__, __LINE__, $文檔碼, $mode );
	
	if( strlen( $文檔碼 ) > 4 )
	{
		$文檔碼 = substr( $文檔碼, 0, 4 );
	}
	
	try
	{
		return 提取數據結構( 完整坐標表文件夾 . $文檔碼 );
	}
	catch( RuntimeException $e )
	{
		throw new InvalidDocumentIDException(
			"文檔碼「${文檔碼}」不存在。"
		);
	}
}
?>