<?php
require_once( 'h:\github\Dufu-Analysis\page_multiple_verse.php' );
$path_for_file = '';
$text_of_file  = '';

function getAnnotation( $file_path ) : string
{
	global $path_for_file;
	global $text_of_file;

	$annotation = "";
	$text       = "";
	// only load file if the path is new
	if( $file_path != $path_for_file )
	{
		$path_for_file = $file_path;
		$text = getFile( $file_path );
		$text_of_file = $text;
	}
	$lines = explode( "\n", $text );
	$first_line = $lines[ 0 ];
	$pos = strpos( $first_line, '[');
	
	if( $pos !== false )
	{
		$annotation = 
			trim( substr( $first_line, $pos, -1 ), '[]' );
	}

	return $annotation;
}

function getFile( $file_path ) : string
{
	$text_of_file = file_get_contents( $file_path );
	return $text_of_file;
}

function getOrderOfPoem( array $titles, $l_int ) : int
{
	$count = 0;
	
	for( $i = 0; $i < sizeof( $titles ); $i++ )
	{
		if( $l_int > $titles[ $i ] )
		{
			$count++;
		}
	}
	return $count;
}

function getPoem( string $path ) : string
{
	global $page_multiple_verse;
	global $poem_with_preface;
	global $page_path;
	global $path_for_file;
	global $text_of_file;
	
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$text_array = array();
	$skip = '';
	
	$path_array = explode( "\\", $path );
	
	$page = substr( $path_array[ sizeof( $path_array ) - 1 ], 0, 4 );
	$multi_verse = array_key_exists( 
		$page, $page_multiple_verse );
	
	if( array_key_exists( $path, $poem_with_preface ) )
	{
		$skip = $poem_with_preface[ trim( $path ) ];
	}
	
	for( $i = 0; $i < sizeof( $lines ); $i++ )
	{
		// skip first line
		if( $i == 0 )
		{
			continue;
		}
		elseif( ( $skip != '' && is_array( $skip ) && 
			in_array(  $i+1, $skip ) ) || $lines[ $i ] == '' )
		{
			continue;
		}
		else
		{
			if( substr( $lines[ $i ], 0, 1 ) == '=' )
			{
				break;
			}
			
			else
			{
				if( $multi_verse )
				{
					$l_of_titles = $page_multiple_verse[ $page ][ 1 ];
					if( in_array( ( $i + 1 ), $l_of_titles ) )
					{
						continue; // skip titles
					}
				}

				array_push( $text_array, $lines[ $i ] );
			}
		}
	}
	return normalize( implode( $text_array ) );

	//return "";
}

function getLN( string $path ) : array
{
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$ln_array = array();
	
	for( $i = 0; $i < sizeof( $lines ); $i++ )
	{
		if( substr( $lines[ $i ], 0, 1 ) == '=' )
			break;
		else
		{
			$ln = $i + 1;
			$ln_array[ "〚${ln}〛" ] = $lines[ $i ];
		}
	}
	return $ln_array;
}

function getPreface( string $path ) : string
{
	global $poem_with_preface;
	$preface = "";
	
	if( array_key_exists( $path, $poem_with_preface ) )
	{
		$preface_lines = $poem_with_preface[ $path ];
		
		// not a preface
		if( sizeof( $preface_lines ) > 1 && 
			$preface_lines[1] != 4 )
			return $preface;
	}
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$preface_array = array();
	
	if( array_key_exists( $path, $poem_with_preface ) )
	{

		for( $i = 0; $i < sizeof( $preface_lines ); $i++ )
		{
			$preface_array[ $i ] = $lines[ $preface_lines[ $i ] - 1 ];
		}
		$preface = implode( $preface_array );
	}
	
	
	return $preface;
}

function getSection( string $path, string $prefix ) : array
{
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$found = false;
	$start = 0;
	$end = 0;

	for( $i = 0; $i < sizeof( $lines ); $i++ )
	{
		// found the section
		if( mb_strpos( $lines[ $i ], $prefix ) !== false )
		{
			$found = true;
			$start = $i + 1;
		}
		elseif( $found ) // in the section, before the next =
		{
			if( substr( $lines[ $i ], 0, 1 ) == '=' )
			{
				$end = $i;
				break;
			}
		}
	}
	$text_array = array_slice( $lines, $start, $end - $start );
	return $text_array;
}

function normalize( string $text ) : string
{
	$text = 
		str_replace( "？", "。", // use 。
		str_replace( "，", "。",
		str_replace( "！", "。",
		str_replace( "：", "。",
		str_replace( "；", "。",
		str_replace( "、", "。",
		str_replace( "《", "",   // remove these
		str_replace( "》", "",
		str_replace( "其一", "",
		str_replace( "其二", "",
		str_replace( "其三", "",
		str_replace( "其四", "",
		str_replace( "其五", "",
		str_replace( "其六", "",
		str_replace( "其七", "",
		str_replace( "其八", "",
		str_replace( "其九", "",
		str_replace( "其十", "",
		str_replace( "其十一", "",
		str_replace( "其十二", "",
		str_replace( "其十三", "",
		str_replace( "其十四", "",
		str_replace( "其十五", "",
		str_replace( "其十六", "",
		str_replace( "其十七", "",
		str_replace( "其十八", "",
		str_replace( "其十九", "",
		str_replace( "其二十", "", $text
		))))))))))))))))))))))))))));  
	$text = preg_replace( '/[\d]+ [\P{M}]+?\n/', "", $text );
	$text = preg_replace( '/[\s]+/', "", $text );

	return $text;
}

function 取杜甫文件名稱() : array
{
	$sub_folder_array = array();
	$file_names       = array();

	if( is_dir( 杜甫文件夾 ) )
	{
	$sub_folders = scandir( 杜甫文件夾 );
	
	// store all sub-folder names in DuFu
	foreach( $sub_folders as $sub_folder )
	{
		if( $sub_folder != "." && 
			$sub_folder != ".." &&	
			is_dir( 杜甫文件夾 . $sub_folder ) )
		{
			array_push( $sub_folder_array, 
				杜甫文件夾 . $sub_folder );
		}
	}
	// store all text file names
	foreach( $sub_folder_array as $cfolder )
	{
		$files = scandir( $cfolder );
		
		foreach( $files as $file )
		{
			if( $file != '.' && $file != '..' &&
				str_contains( $file, '.txt' )
			)
			{
				array_push( 
					$file_names, $cfolder . "\\" . 
					$file );
			}
		}
	}
	}
	// sort all files names
	sort( $file_names, SORT_STRING );
	
	return $file_names;
}
?>