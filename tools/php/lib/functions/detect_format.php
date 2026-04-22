<?php
/*
 *
 */
function detect_format( string $str ) : string
{
    // try JSON
    json_decode( $str, true );
	
    if( json_last_error() === JSON_ERROR_NONE )
	{
        return 'json';
    }

    // try JSONL
    $lines = preg_split( '/\r\n|\r|\n/', trim( $str ) );
    $valid = true;
    $count = 0;

    foreach( $lines as $line )
	{
        if( $line === '' ) continue;
        $count++;

        json_decode( $line, true );
		
        if( json_last_error() !== JSON_ERROR_NONE )
		{
            $valid = false;
            break;
        }
    }

    if( $valid && $count > 1 )
	{
        return 'jsonl';
    }

    return 'string';
}
?>