<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\文賦\test.php
*/
require_once( 
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$文檔碼 = '6124';
$filepath = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
	默認版本文賦文件夾 . "${文檔碼}.txt";
	
if( file_exists( $filepath ) )
{
	// part 1: read a file, create a map
	$contents = file_get_contents( $filepath );
	//echo $contents;
	$paragraphs = explode( NL.NL, $contents );
	$text = '';
	$順序碼_字 = array( '' ); //index 0
	
	// if there is a prefix, start from 2
	for( $i = 1; $i < count( $paragraphs ); $i++ )
	{
		$text .= 規範化( $paragraphs[ $i ], true, true, true );
	}
	//echo $text, NL;
	//echo mb_strlen( $text ), NL;
	for( $j = 0; $j < mb_strlen( $text ); $j++ )
	{
		$順序碼_字[] = mb_substr( $text, $j, 1 );
	}
	
	// write the file
	//print_r( $順序碼_字 );
	
	// part 2: create an empty tree
	$樹 = array();
	$樹[ $文檔碼 ] = array();
	$段句字 = 文賦段句字[ $文檔碼 ]; 
	$段數 = count( $段句字 );
	
	foreach( range( 1, $段數 ) as $段碼 )
	{
		$樹[ $文檔碼 ][ "${段碼}" ] = array();
		$句數 = count( $段句字[ $段碼 - 1 ] );
		
		foreach( range( 1, $句數 ) as $句碼 )
		{
			$樹[ $文檔碼 ][ "${段碼}" ][ "${句碼}" ] = 
				array();
			$字數 = $段句字[ $段碼 - 1 ][ $句碼 - 1 ];
			
			foreach( range( 1, $字數 ) as $字碼 )
			{
				$樹[ $文檔碼 ][ "${段碼}" ][ "${句碼}" ]
					[ "${字碼}" ] = '';
			}
		}
	}
	
	// part 3: fill the tree with data
	
	$index = 0;
	$paths = array();
	$map   = array();
	recusively_fill_data( $樹, '' );
	//print_r( $樹 );
	print_r( $map );
	
	
}

function recusively_fill_data(
	array &$tree, string $path ) : void
{
	global $text;
	global $index;
	global $paths;
	global $map;
	$keys = array_keys( $tree );
	
	foreach( $keys as $key )
	{
		$temp = ltrim( $path, ',' );
		
		/*
		if( $temp !== "" && !in_array( $temp, $paths ) )
		{
			$paths[] = $temp;
		}
		*/
		
		if( is_array( $tree[ $key ] ) )
		{
			recusively_fill_data( $tree[ $key ], 
				$temp . ',' . $key );
		}
		else
		{
			$tree[ $key ] = mb_substr( $text, $index, 1 );
			$index++;
			$map[ ltrim( $path, ',' ) . ',' . $key ] = 
				$index;
		}
	}
}
?>