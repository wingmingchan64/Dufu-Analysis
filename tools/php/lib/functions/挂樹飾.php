<?php
/*
 * JINGQUAN, 0001
 */
use CTT\Exceptions\IllegalWorkIDException;

function 挂樹飾(
	string $默文碼,
	string $著述版文碼,
	array $m_paths ) : array
{
	global $ctt_registry;
	
	[ $著述碼, $版文碼 ] = explode( ',', $著述版文碼 );
	// error checking
	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	// 正文樹
	$樹 = 提取基準正文樹( $默文碼 );
	添加標點符號( $樹 );
	添加錨( $樹 );
	
	foreach( $m_paths as $path )
	{
		[ $dummy1, $dummy2, $部分, $範圍, $來源, $函式 ] =
			explode( '_', $path );
		$replace = ( $函式 == 'replace' );
		$路徑 = explode( ',', $範圍 );
		
		// replace scope x-y with a
		if( strpos( 
			$路徑[ count( $路徑 ) - 1 ],
			'-' ) !== false )
		{
			$路徑[ count( $路徑 ) - 1 ] = 'a';
		}
		
		$text = 提取ctt正文( $來源 );
			
		if( !$replace )
		{
			$text =
				"〈${部分}*${範圍}*${text}〉";
		}
		// newly added
		else
		{
			//$text =
				//"〈替換*${範圍}*${text}〉";
		}

		if( $函式 == 'insert' )
		{
			插入路徑字( $樹, $路徑, $text );
		}
		elseif( $函式 == 'replace' )
		{
			替換路徑字( $樹, $路徑, $text );
		}
	}
		
	return $樹;
}

function attach_tree_ornaments(
	string $默文碼,
	string $著述版文碼,
	array $m_paths ) : array
{
	return 挂樹飾( $默文碼, $著述版文碼, $m_paths );
}
?>