<?php
/*
 * 生成文賦順序碼。
 */
use Dufu\Exceptions\DocumentIDNotFoundException;

function 生成文賦順序碼( string $文檔碼, string $file_path ) :
	void
{
	if( !in_array( $文檔碼, 文賦默認文檔碼 ) )
	{
		throw new DocumentIDNotFoundException(
			"文檔碼「${文檔碼}」不存在。" );
	}
	
	$有序言 = in_array( $文檔碼, 帶序言之文賦 );
	
	
}
?>