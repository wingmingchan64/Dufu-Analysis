<?php
/*
php h:\github\Dufu-Analysis\《全唐詩》\插入詩題.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$content = file_get_contents(
'H:\github\Dufu-Analysis\《全唐詩》\全目錄.txt' );
$lines = explode( NL, $content );
$content = '';
$temp = array();

foreach( $lines as $line )
{
	$parts = explode( ' ', $line );
	//echo $line, NL;
	//echo $parts[3], NL;
	$number = substr( $parts[3], 2, 4 );
	
	if( !array_key_exists( $number, $temp ) )
	{
		$temp[ $number ] = array();
	}
	array_push( $temp[ $number ], $line );
}
ksort( $temp );
foreach( $temp as $number => $lines )
{
	foreach( $lines as $line )
	{
		echo $line, NL;
	}
}
?>