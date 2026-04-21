<?php
/*
 * 以詩碼提取基準正文樹。
 * 例：提取基準正文樹( '0013-1' )
 */
use Dufu\Exceptions\DocumentIDNotFoundException;

function 提取基準正文樹(
	string $默文檔碼, bool $debug=false ) : array
{
	$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
	
	if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
	{
		if( !in_array( $默文檔碼, $默認版本詩碼 ) )
		{
			throw new DocumentIDNotFoundException(
				"默文檔碼「${默文檔碼}」不存在。" );
		}
	}
	
	return 提取數據結構( BASE_TEXT_DIR . $默文檔碼 );
}

function get_base_text_tree( 
	string $默文檔碼, bool $debug=false ) : array
{
	return 提取基準正文樹( $默文檔碼, $debug );
}
?>