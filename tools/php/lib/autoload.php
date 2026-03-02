<?php
declare( strict_types = 1 );

spl_autoload_register( function ( string $class ): void
{
    $prefix = 'Dufu\\';
	
    if( strncmp( $class, $prefix, strlen( $prefix ) ) !== 0 )
	{
        return;
    }

    $relative = substr( $class, strlen( $prefix ) ); // e.g. Tools\JsonDataLoader
    $path = __DIR__ . DIRECTORY_SEPARATOR
          . str_replace( '\\', DIRECTORY_SEPARATOR, $relative )
          . '.php';

    if( is_file( $path ) )
	{
        require $path;
    }
} );
?>