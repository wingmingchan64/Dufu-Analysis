<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\文賦\process_prose.php
*/
require_once( 
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$文檔碼 = '6111';
$filepath = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
	默認版本文賦文件夾 . "${文檔碼}.txt";
$file_contents = file_get_contents( $filepath );
$行s = explode( NL.NL, $file_contents );
$paragraphs = explode( NL.NL, $file_contents );
$文字塊 = '';
$樹骨架 = array();
$樹字數 = 0;
$文字樹 = array();
$樹 = array();
$樹[ $文檔碼 ] = array();
$樹[ $文檔碼 ][ 篇名 ] = '';
$題 = '';

for( $i = 0; $i < count( $paragraphs ); $i++ )
{
	if( $i == 0 )
	{
		$題 = preg_replace( '/\d{4}/', '',
			str_replace( ' ', '',
			preg_replace( 夾注regex, '',
			$paragraphs[ $i ] ) ) );
		$樹骨架[] = array( mb_strlen( $題 ) );
		$文字塊 = $題;
		echo "題:", $題, NL;
		$樹[ $文檔碼 ][ 篇名 ] = $題;
		$樹字數 += mb_strlen( $題 );
		continue;
	}
	else
	{
		$文字塊 .= 
			規範化( $paragraphs[ $i ], true, true, true );
	}
	
	$段陣列 = array();
	$行s = explode( NL, $paragraphs[ $i ] );
		
	foreach( $行s as $行 )
	{
		$行陣列 = array();
		$句s = explode( '。', $行 );
		
		foreach( $句s as $句 )
		{
			if( $句 == '' )
			{
				continue;
			}
			//echo mb_strlen( $句 ), NL;
			if( mb_strlen( $句 ) == 12 )
				echo $句, NL;
			$行陣列[] = mb_strlen( $句 );
		}
		$段陣列[] = $行陣列;
	}
	$樹骨架[] = $段陣列;
}

//print_r( json_encode( $樹骨架 ) );

for( $i = 0; $i < mb_strlen( $文字塊 ); $i++ )
{
	$碼 = $i + 1;
	$文字樹[ "$碼" ] = mb_substr( $文字塊, $i, 1 );
}

//print_r( json_encode( $文字樹, JSON_UNESCAPED_UNICODE ) );

$段數 = count( $樹骨架 ) - 1;
$行_num = 3;

	
	/*
	foreach( $map as $k => $v )
	{
		$map[ $k ] = $順序碼_字[ $v ];
	}
	*/


foreach( range( 1, $段數 ) as $段碼 )
{
	//$行_num++;
	//$行_num++;
	$行數 = count( $樹骨架[ $段碼 ] );
	
	//$樹[ $文檔碼 ][ "${段碼}" ] = array();
	foreach( range( 1, $行數 ) as $行碼 )
	{
		$樹骨架[ $段碼 ][ $行_num ] = array();
		$句數 = count( $樹骨架[ $段碼 ][ $行碼 - 1 ] );
		
		foreach( range( 1, $句數 ) as $句碼 )
		{
			$樹[ $文檔碼 ][ "${段碼}" ][ $行_num ]
				[ "${句碼}" ] = array();
			$字數 = $樹骨架[ $段碼 ][ $行碼 - 1 ][ $句碼 - 1 ];
			$樹字數 += $字數;
			foreach( range( 1, $字數 ) as $字碼 )
			{
				$樹[ $文檔碼 ][ "${段碼}" ][ $行_num ]
					[ "${句碼}" ][ "${字碼}" ] = '';
			}
		}
		$行_num++;
	}
	$行_num++;
}

$index = mb_strlen( $題 ); // skip title
$paths = array();
$map   = array();
recusively_fill_data( $樹, '' );
//print_r( json_encode( $樹, JSON_UNESCAPED_UNICODE ) );
//print_r( $map );
print_r( $文字樹 );

function recusively_fill_data(
	array &$tree, string $path ) : void
{
	global $文字塊;
	global $index;
	global $paths;
	global $map;
	$keys = array_keys( $tree );
	
	foreach( $keys as $key )
	{
		$temp = ltrim( $path, ',' );
		
		if( $key == 篇名 )
		{
			//$index = mb_strlen( $tree[ $key ] ) - 2;
			$tree[ $key ] = $tree[ $key ]; // do nothing
		}
		elseif( is_array( $tree[ $key ] ) )
		{
			recusively_fill_data( $tree[ $key ], 
				$temp . ',' . $key );
		}
		else
		{
			$tree[ $key ] = mb_substr( $文字塊, $index, 1 );
			$index++;
			$map[ ltrim( $path, ',' ) . ',' . $key ] = 
				$index;
		}
	}
}

?>