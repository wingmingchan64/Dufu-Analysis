<?php
/**
php H:\github\Dufu-Analysis\docs\workflow\demo_php_program\tree_operations.php
*/

// part 1: create a tree

// read in 基準正文 from a file
// $基準正文 = file_get_contents( $file );
$newline = "\r\n";
$基準正文 = <<<EOD
0003 望嶽

岱宗夫如何。齊魯青未了。
造化鍾神秀。陰陽割昏曉。
盪胸生曾雲。決眥入歸鳥。
會當凌絕頂。一覽眾山小。
EOD;
// split the contents
$lines = explode( $newline, trim( $基準正文 ) );
$line_num = 0;
$基準正文樹 = array();
$文檔碼 = '';

foreach( $lines as $line )
{
	$line_num++;
	
	// first line
	if( $line_num == 1 )
	{
		[ $文檔碼, $詩題 ] = 
			explode( ' ', trim( $line ) );
		 $基準正文樹[ $文檔碼 ] = array();
		 $基準正文樹[ $文檔碼 ][ '詩題' ] = $詩題;
	}
	// skip empty string
	elseif( $line === "" )
	{
		continue;
	}
	else
	{
		$line = rtrim( $line, '。' );
		$segments = explode( '。', $line );
		$segment_num = 0;
		
		foreach( $segments as $segment )
		{
			$segment_num++;
			$基準正文樹[ $文檔碼 ][ $line_num ]
				[ $segment_num ] = array();
			$len_of_segment = mb_strlen( $segment );
			//echo $len_of_segment, $newline;
			for( $i=0; $i<$len_of_segment; $i++ )
			{
				$基準正文樹[ $文檔碼 ][ $line_num ]
					[ $segment_num ][ $i+1 ] = 
						mb_substr( $segment, $i, 1 );
			}
		}
		
	}
}
print_r( $基準正文樹 );

// part 2: retrieve a subtree

$子樹 = $基準正文樹[ $文檔碼 ][ '3' ];
print_r( $子樹 );

// part 3: create path set and create map
$paths = array();
$map = array();
$reverse_map = array();
$path = '';
recursive_get_paths( $基準正文樹, $path );

function recursive_get_paths(
	array $tree, string $path ) : void
{
	global $paths;
	global $map;
	$keys = array_keys( $tree );
	
	foreach( $keys as $key )
	{
		if( is_array( $tree[ $key ] ) )
		{
			recursive_get_paths(
				$tree[ $key ], $path . ',' . $key );
		}
		else
		{
			$paths[] = ltrim( $path, ',' ) . ',' . $key;
			$map[ ltrim( $path, ',' ) . ',' . $key ] =
				$tree[ $key ];
		}
	}
}

$reverse_map = array_flip( $map );
print_r( $paths );
print_r( $map );
print_r( $reverse_map );

// part 4: traverse a path and change a value

$path = '0003,5,1,4'; // change 曾 to 層
$steps = explode( ',', $path );
traverse_replace( $基準正文樹, $steps, '層' );

function traverse_replace(
	array &$tree, array $steps, string $v ) : void
{
	$pointer = &$tree;
	
	foreach( $steps as $step )
	{
		$pointer = &$pointer[ $step ];
	}
	$pointer = $v;
}
print_r( $基準正文樹 );

// part 5: quick lookup
echo $map[ '0003,3,2,2' ], $newline;
echo $reverse_map[ '小' ], $newline;
?>