<?php
/*
 *
 */
use Dufu\Exceptions\JsonFileNotFoundException;

function 有序言(
	string $文檔碼, bool $debug=false ) : bool
{
	return in_array( $文檔碼, 提取數據結構( 帶序言之詩 ) );
}

function has_preface(
	string $文檔碼, bool $debug=false ) : bool
{
	return 有序言( $文檔碼, $debug );
}
?>