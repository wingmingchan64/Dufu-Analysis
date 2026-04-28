<?php
function is_legal_path(
	string $work_id,
	string $path,
) : bool
{
	$folder = get_ctt_folder( $work_id );
	$paths = json_decode( file_get_contents(
		dirname( __DIR__, 5 ) . 
		DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR .
		$folder . DIRECTORY_SEPARATOR .
		'coordinates' . DIRECTORY_SEPARATOR .
		'paths.json' ), true );
	
	return in_array( $path, $paths );
}

function 是合法路徑( string $work_id, string $path ) : bool
{
	return is_legal_path( $work_id, $path );
}
?>