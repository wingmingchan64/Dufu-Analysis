<?php
/*
 * 以詩碼提取樹文字內容。
 * 例：提取基準正文樹( '0013-1' )，回傳《題張氏隱居二首》其一
 */
use Dufu\Exceptions\PoemIDNotFoundException;
use Dufu\Exceptions\JsonFileNotFoundException;

function 提取詩碼樹文字內容( 
	string $詩碼, array &$樹, bool $debug=false ) : string
{
	if( !是默認詩碼( $詩碼 ) )
	{
		throw new PoemIDNotFoundException( "詩碼「${詩碼}不存在。」" );
	}
	
	$contents = '';
	// get the set of 句坐標
	$默認詩碼_句坐標 = 提取數據結構( 默認詩碼_句坐標 );
	
	foreach( $默認詩碼_句坐標[ $詩碼 ] as $句坐標 )
	{
		// walk down the tree to get the segments
		$路徑 = 完整坐標轉換成路徑列陣( $句坐標 );
		$pointer = &$樹;
		
		foreach( $路徑 as $step )
		{
			$pointer = &$pointer[ $step ];
		}
		// get the contents of segments
		$contents .= implode( $pointer );
	}
	
	return $contents;
}

function get_poem_id_tree_contents(
	string $詩碼, array &$樹, bool $debug=false ) : string
{
	return 提取詩碼基準正文樹( $詩碼 );
}
?>