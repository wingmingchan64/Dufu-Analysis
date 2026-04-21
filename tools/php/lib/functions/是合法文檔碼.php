<?php
/*
 * 詩文片段是否存在於詩中。
 */
use Dufu\Exceptions\JsonFileNotFoundException;

function 是合法文檔碼( string $碼, bool $debug=false ) : bool
{
	$默文檔碼 = 提取數據結構( 默認詩文檔碼 );
	return in_array( $碼, $默文檔碼 );
}

function is_legal_doc_id(
	string $碼, bool $debug=false ) : bool
{
	return 是合法文檔碼( $碼, $debug );
}
?>