<?php
/*
 * 不檢查路徑是否合法。只適用於基準正文樹。
 */
use Dufu\Exceptions\DocumentIDNotFoundException;

function 是默認無字碼路徑( string $path ) : bool
{
	if( mb_strpos( $path, 逗號 ) === false )
	{
		return false;
	}
	else
	{
		$parts = explode( 逗號, $path );
		$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
		//print_r( $默認詩文檔碼 );
		$默文檔碼 = trim( $parts[ 0 ] );
		
		if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
		{
			throw new DocumentIDNotFoundException(
				"默文檔碼「${默文檔碼}」不存在。" 
			);
		}
		
		return 
			( 是組詩( $默文檔碼 ) ) ? 
				count( $parts ) == 4 :
				count( $parts ) == 3;
	}
}
?>