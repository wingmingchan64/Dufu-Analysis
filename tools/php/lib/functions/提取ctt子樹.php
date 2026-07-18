<?php
use CTT\Exceptions\IllegalCoordinateException;

function retrieve_subtree_from_ctt(
	string $path, bool $add_punctuation = false ) : array
{
	$parts = explode( ',', $path );
	$work_id = $parts[ 0 ];
	
	if( !is_edition_legal_path( $parts[ 0 ], $path ) )
	{
		throw new IllegalCoordinateException( $path . " not a legal path." );
	}
	global $ctt_registry;
	
	$tree_path = dirname( __FILE__, 6 ) . 	
		DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR .
		get_ctt_folder( $work_id ) .
		DIRECTORY_SEPARATOR .
		'trees' . DIRECTORY_SEPARATOR . 
		$parts[ 1 ] . '.json';
	
	$tree = json_decode(
		file_get_contents( $tree_path ), true );
		
	//print_r( $tree );
		
	if( $add_punctuation )
	{
		add_punctuation( $tree );
	}
	//print_r( $tree );
	$pointer = $tree;
	
	//for( $i = 1; $i < count( $parts ); $i++ )
	foreach( $parts as $step )
	{
		if( $step == $work_id )
		{
			continue;
		}
		$pointer = $pointer[ $step ];
	}
	return $pointer;;
}

function 提取ctt子樹(
	string $path, bool $add_punctuation = false ) : array
{
	return retrieve_subtree_from_ctt(
		$path, $add_punctuation );
}
?>