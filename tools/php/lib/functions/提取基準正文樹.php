<?php
/*
 * 以詩碼提取基準正文樹。
 * 例：提取基準正文樹( '0013-1' )
 */
use Dufu\Exceptions\PoemIDNotFoundException;

function 提取基準正文樹(
	string $默詩碼, bool $debug=false ) : array
{
	$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
	
	if( !in_array( $默詩碼, $默認版本詩碼 ) )
	{
		throw new PoemIDNotFoundException(
			"默詩碼「${默詩碼}」不存在。" );
	}
	
	return 提取數據結構( BASE_TEXT_DIR . $默詩碼 );
}

function get_base_text_tree( 
	string $默詩碼, bool $debug=false ) : array
{
	return 提取基準正文樹( $默詩碼, $debug );
}
?>