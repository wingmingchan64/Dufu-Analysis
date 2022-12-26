<?php
require_once( "h:\\github\\Dufu-Analysis\\詩組_詩題.php" );
require_once( "h:\\github\\Dufu-Analysis\\帶序文之詩歌.php" );
require_once( "h:\\github\\Dufu-Analysis\\頁碼_路徑.php" );
$path_for_file = '';
$text_of_file  = '';

// 提取題注（原注）
// $file_path: h:\github\DuFu\01 卷一 3-270\0048 過宋員外之問舊莊.txt
function getAnnotation( string $file_path ) : string
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

// 決定一行詩在詩組中，屬於哪一首，用於計算首碼
// titles: 詩組_詩題, example: ( 3, 10, 13, 20 )
// $l_int: 詩句的行碼
function getOrderOfPoem( array $titles, int $l_int ) : int
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

// 提取詩文
// $file_path: h:\github\DuFu\01 卷一 3-270\0048 過宋員外之問舊莊.txt
// 宋公舊池館。零落首陽阿。枉道祗從入。吟詩許更過。
// 淹留問耆老。寂寞向山河。更識將軍樹。悲風日暮多。
function getPoem( string $path ) : string
{
	global $詩組_詩題;
	global $帶序文之詩歌;
	global $頁碼_路徑;
	//global $path_for_file;
	//global $text_of_file;
	
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$text_array = array();
	$skip = '';
	
	$path_array = explode( "\\", $path );
	
	$page = substr(
		$path_array[ sizeof( $path_array ) - 1 ], 0, 4 );
	$multi_verse = array_key_exists( $page, $詩組_詩題 );
	
	echo $page, 新行;
	
	if( array_key_exists( $path, $帶序文之詩歌 ) )
	{
		$skip = $帶序文之詩歌[ trim( $path ) ];
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
					$l_of_titles = $詩組_詩題[ $page ][ 1 ];
					if( in_array( ( $i + 1 ), $l_of_titles ) )
					{
						continue; // skip 副題
					}
				}

				array_push( $text_array, $lines[ $i ] );
			}
		}
	}
	return normalize( implode( $text_array ) );
}

// 在詩文之前加上行碼
/*
Array
(
    [〚1〛] => 0048 過宋員外之問舊莊[員外季弟執金吾，見知於代，故有下句]
    [〚2〛] =>
    [〚3〛] => 宋公舊池館，零落首陽阿。
    [〚4〛] => 枉道祗從入，吟詩許更過。
    [〚5〛] => 淹留問耆老，寂寞向山河。
    [〚6〛] => 更識將軍樹，悲風日暮多。
)
*/
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

// 提取序文
// $帶序文之詩歌
function getPreface( string $path ) : string
{
	global $帶序文之詩歌;
	$preface = "";
	
	if( array_key_exists( $path, $帶序文之詩歌 ) )
	{
		$preface_lines = $帶序文之詩歌[ $path ];
		
		// not a preface
		if( sizeof( $preface_lines ) > 1 && 
			$preface_lines[1] != 4 )
			return $preface;
	}
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$preface_array = array();
	
	if( array_key_exists( $path, $帶序文之詩歌 ) )
	{
		for( $i = 0; $i < sizeof( $preface_lines ); $i++ )
		{
			$preface_array[ $i ] = $lines[ $preface_lines[ $i ] - 1 ];
		}
		$preface = implode( 新行, $preface_array );
	}
	
	return $preface;
}

// 提取某個帶像「=浦」一類標記的部分。
// return: array
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

function 提取杜甫文件名稱() : array
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