<?php
/*
 * 調試、除錯用。
 */
function debug_echo( 
	string $file, string $line, 
	string $msg, bool $mode = false ) : bool
{
	if( $mode )
	{
		echo 
			str_replace( dirname( __DIR__, 1 ) .
			DIRECTORY_SEPARATOR, 
			'', $file ) . " : #" . 
			$line . " : " . $msg, NL;
	}
	return true;
}

function debug_print_r( 
	string $file, string $line, 
	mixed $obj, bool $mode = false ) : bool
{
	if( $mode )
	{
		echo 
			str_replace( dirname( __DIR__, 1 ) .
			DIRECTORY_SEPARATOR, 
			'', $file ) . " : #" . 
			$line . " : ", NL;
		print_r( $obj );
	}
	return true;
}

?>