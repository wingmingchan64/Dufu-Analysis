<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\run_dict.php
*/
require_once( "dict.php" );
$key = "";

while( true && $key != "exit" && $key != "EXIT" )
{
	$key = trim( fread( STDIN, 80 ) );

	if( array_key_exists( $key, $dict ) )
	{
		print_r( $dict[ $key ] );
		echo "\n";
	}
	elseif( array_key_exists( strtoupper( $key ), $dict ) )
	{
		print_r( $dict[ strtoupper( $key ) ] );
		echo "\n";
	}
}
?>