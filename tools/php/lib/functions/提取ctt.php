<?php
use CTT\Exceptions\IllegalWorkIDException;

function retrieve_ctt(
	string $著述版文碼 ) : array
{
	global $ctt_registry;
	[ $著述碼, $版文碼 ] = explode( ',', $著述版文碼 );
	// error checking
	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	
	global $ctt_registry;
	$tree_path = dirname( __FILE__, 6 ) . 	
		DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR .
		get_ctt_folder( $著述碼 ) .
		DIRECTORY_SEPARATOR .
		'trees' . DIRECTORY_SEPARATOR . 
		$版文碼 . '.json';
	$tree = json_decode(
		file_get_contents( $tree_path ), true );
		
	return $tree;
}

function 提取ctt(
	string $著述版文碼 ) : string
{
	return retrieve_text_from_ctt( $著述版文碼 );
}
?>