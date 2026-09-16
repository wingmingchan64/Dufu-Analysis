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
//$樹骨架 = array();

$txt = '臣甫言臣生長陛下淳樸';
$txt_tree = array();

for( $i=0; $i<mb_strlen( $txt ); $i++ )
{
	$碼 = $i + 1;
	$txt_tree[ "$碼" ] = mb_substr( $txt, $i, 1 );
}
// replace
$txt_tree[ 2 ] = '';
$txt_tree[ 3 ] = '云';
// insert
$txt_tree[ 4 ] = $txt_tree[ 4 ] . '不得';
print_r( implode( $txt_tree ) );
exit;
$樹骨架 = array(
	array( 3, 7, 9, 2 ),
	array( 4, 4, 8 ),
	array( 2, 5 ),
	array( 6, 9, 8 )
);
// 段
$last_parag = array_pop( $樹骨架 ); // 6,9,8
$first_parag = array_shift( $樹骨架 ); // 3,7,9,2
$樹骨架 = array_merge(
	array_slice( $樹骨架, 0, 1 ), // 4,4,8
	array( $last_parag, $first_parag ),
	array_slice( $樹骨架, 1 )
);
print_r( $樹骨架 );

// remove an array in the middle
$樹骨架 = array_merge(
	array_slice( $樹骨架, 0, 2 ),
	array_slice( $樹骨架, 3, 1 ),
	
);
print_r( $樹骨架 );

// 句
$樹骨架[ 0 ] = array_merge(
	array_splice( $樹骨架[ 0 ], 0, 1 ),
	array_splice( $樹骨架[ 0 ], 1 ) );

print_r( $樹骨架 );

$樹骨架 = array();

//exit;
	
if( file_exists( $filepath ) )
{
	// part 1: read a file, create a map
	$contents = file_get_contents( $filepath );
	
	//echo $contents;
	$paragraphs = explode( NL.NL, $contents );
	
	foreach( $paragraphs as $paragraph )
	{
		if( mb_strpos( $paragraph, '。' ) === false )
			continue;
		$temp = array();
		$segs = explode( '。', trim( $paragraph ) );
		foreach( $segs as $seg )
		{
			if( $seg != '' )
				$temp[] = mb_strlen( $seg );
		}
		 
		$樹骨架[] = $temp;
	}
	
	//print_r( $樹骨架 );
	/*
	if( 文賦段句字[ $文檔碼 ] == $樹骨架 )
		echo "=";
	else
		echo "!=";
	exit;
	*/
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
	//$樹骨架 = 文賦段句字[ $文檔碼 ]; 
	$段數 = count( $樹骨架 );
	
	foreach( range( 1, $段數 ) as $段碼 )
	{
		$樹[ $文檔碼 ][ "${段碼}" ] = array();
		$句數 = count( $樹骨架[ $段碼 - 1 ] );
		
		foreach( range( 1, $句數 ) as $句碼 )
		{
			$樹[ $文檔碼 ][ "${段碼}" ][ "${句碼}" ] = 
				array();
			$字數 = $樹骨架[ $段碼 - 1 ][ $句碼 - 1 ];
			
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
	//print_r( $map );
	foreach( $map as $k => $v )
	{
		$map[ $k ] = $順序碼_字[ $v ];
	}
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