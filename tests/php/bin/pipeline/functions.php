<?php
function convert_text_to_tree(
	string $root, string $text
) : array
{
	$tree = [];
	$tree[ $root ] = [];
	
	$lines = preg_split( "/\R/u", $text );
	
	for( $i = 0; $i < count( $lines ); $i++ )
	{
		$line_num = $i + 1;
		
		if( $line_num == 1 )
		{
			$header = trim( $lines[ $i ] );
			$header_parts = 
				preg_split( '/\s+/u', $header, 3 );
			$tree[ $root ][ '詩題' ] = $header_parts[ 1 ] ?? '';
		}
		elseif( !$lines[ $i ] )
		{
			continue;
		}
		else
		{
			$tree[ $root ][ "$line_num" ] = 	
				line_to_sentence_tree( $lines[ $i ] );
		}
	}
	return $tree;
}

function convert_annotation_to_tree(
	string $root, string $text
) : array
{
	$tree = [];
	$tree[ $root ] = [];
	
	$lines = preg_split( "/\R/u", $text );
	
	for( $i = 0; $i < count( $lines ); $i++ )
	{
		$line_num = $i + 1;
		
		$tree[ $root ][ "$line_num" ] = 	
			line_to_sentence_tree( $lines[ $i ] );
	}
	return $tree;
}

function line_to_sentence_tree( string $line ): array
{
    $result = [];

    $sentences = array_values( array_filter(
        explode( '。', trim( $line ) ),
        fn( $s ) => $s !== ''
    ) );

    foreach( $sentences as $sent_idx => $sentence )
    {
        $sent_key = ( string )( $sent_idx + 1 );
        $result[ $sent_key ] = [];

        $chars = preg_split( 
			'//u', $sentence, -1, PREG_SPLIT_NO_EMPTY );

        foreach( $chars as $char_idx => $ch )
        {
            $result[ $sent_key ][( string )( $char_idx + 1 )] = $ch;
        }
    }

    return $result;
}

function process_metadata( array &$tree, string $text ) : void
{
	$lines = preg_split( "/\R/u", $text );
	
	foreach( $lines as $line )
	{
		$parts = explode( '〘', $line );
		//print_r( $parts );
		$txt = $parts[ 0 ];
		$marker = rtrim( $parts[ 1 ], '〙' );
		$tags = json_decode( $marker, true );
		
		switch( $tags[ "op" ] )
		{
			case "替換":
				$scope_end = $tags[ "scope_end" ];
				$path = 完整坐標轉換成路徑列陣( $scope_end );
				替換路徑字( $tree, $path, $txt );
				break;
				
			case "插入":
				$scope_end = $tags[ "scope_end" ];
				$path = 完整坐標轉換成路徑列陣( $scope_end );
				插入路徑字( $tree, $path, '[' . $txt . ']' );
				break;
				
			case "植入":
				$scope_end = $tags[ "scope_end" ];
				$path = 完整坐標轉換成路徑列陣( $scope_end );
				$子樹path = dirname( __FILE__ ) .
					DIRECTORY_SEPARATOR . $txt . '.json';
				$子樹 = json_decode(
					file_get_contents( $子樹path ), true );
				//print_r( $子樹 );
				植入子樹( $tree, $path, $子樹 );
				break;
		}
	}
}


function 植入子樹(
	array &$tree, array $path, array $subtree ) : void
{
	$pointer = &$tree;
	
	for( $i = 0; $i < count( $path ); $i++ )
	{
		$pointer = &$pointer[ $path[ $i ] ];
	}
	
	if( is_string( $pointer ) )
	{
		$txt = $pointer;
		//print_r( $pointer );
		$temp = [];
		$temp[ '1' ] = $txt;
		$temp[ '2' ] = $subtree[ array_keys($subtree)[0] ];
		$pointer = $temp;
	}
	elseif( is_array( $pointer ) )
	{
		$temp = $pointer;
		//print_r( $temp );
		$pointer = '';
		$pointer = $subtree[ array_keys($subtree)[0] ];
	}
}

?>