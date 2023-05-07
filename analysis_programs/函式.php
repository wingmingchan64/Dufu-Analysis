<?php
/*
〖〗
*/
set_error_handler( function ( 
	$severity, $message, $file, $line )
{
    throw new \ErrorException( $message, $severity, 	
		$severity, $file, $line );
});
require_once( '常數.php' );
require_once( 杜甫資料庫 . '詩組_詩題.php' );
require_once( 杜甫資料庫 . '帶序文之詩歌.php' );
require_once( 杜甫資料庫 . '頁碼_路徑.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );
require( 杜甫資料庫 . '坐標_詩句.php' );
require_once( 杜甫資料庫 . '頁碼_詩題.php' );
$path_for_file = '';
$text_of_file  = '';

// 比較兩段文字。如果字數不同，不比較。
function compareText( string $text1, string $text2, bool $removePunctuation = false ) : array
{
	$difference = array();
	$text1 = normalize( $text1, true, true, $removePunctuation );
	$text2 = normalize( $text2, true, true, $removePunctuation );
	$len1 = mb_strlen( $text1 );
	$len2 = mb_strlen( $text2 );
	
	if( $len1 != $len2 )
	{
		array_push( $difference, "${len1}，${len2}，字數不同，不能比較。" );
		echo $text1, "\n";
		echo $text2, "\n";
		return $difference;
	}
	for( $i = 0; $i < $len1; $i++ )
	{
		$char1 = mb_substr( $text1, $i, 1 );
		$char2 = mb_substr( $text2, $i, 1 );
		
		if( $char1 != $char2 )
		{
			$difference[ $i ] = array( $char1, $char2 );
		}
	}
	
	return $difference; // could be empty
}


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

function getExpandedPages( string $coor ) : array
{
	$parts = explode( '.', $coor );
	
	if( sizeof( $parts ) < 3 )
	{
		return array( $coor );
	}
	else
	{
		$pages = 
			trim( $parts[ sizeof( $parts ) - 1 ], '〛' );
			
		if( strpos( $pages, '-' ) !== false )
		{
			$page_array = array();
			$pre_parts = "";
			
			for( $i = 0; $i < sizeof( $parts ) - 1; $i ++ )
			{
				$pre_parts = $pre_parts . '.' . $parts[ $i ];
			}
			$pre_parts = trim( $pre_parts, '.' );
			$page_range = explode( '-', $pages );			

			if( sizeof( $page_range ) == 2 )
			{
				$page_range_array = 
					range( $page_range [ 0 ], $page_range [ 1 ] );
				
				foreach( $page_range_array as $p )
				{
					array_push(
						$page_array,
						$pre_parts . '.' . $p . '〛' );
				}
			}
			
			return $page_array;
		}
		else
		{
			return array( $coor );
		}
		
		echo $pages, "\n";
	}
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
	
	for( $i = 0; $i < sizeof( $lines ); $i++ )
	{
		// skip first line
		if( $i == 0 )
		{
			continue;
		}
		// skip 序言
		elseif( in_array( $path, $帶序文之詩歌 ) && $i == 2 )
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
	//echo $path;
/*	
	if( in_array( $path, $帶序文之詩歌 ) )
	{
		$preface_line = 3;
		
		// not a preface
		if( sizeof( $preface_line ) > 1 && 
			$preface_lines[1] != 4 )
			return $preface;
	}
*/
	$text  = getFile( $path );
	$lines = explode( "\n", $text );
	$preface_array = array();
	
	//echo $path, "\n";
	
	if( in_array( $path, $帶序文之詩歌 ) )
	{
		//$preface = implode( 新行, $preface_array );pri
		$preface = $lines[ 2 ];
		//echo "preface ", $preface, "\n";
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

function normalize( string $text,
	bool $removeSpace = false,
	bool $removeNewline = false,
	bool $removePunctuation = false ) : string
{
	if( $removeSpace )
	{
		$text = str_replace( " ", "", $text );
	}
	if( $removeNewline )
	{
		$text = str_replace( "\n", "", $text );
	}
	$text = 
		str_replace( "？", "。", // use 。
		str_replace( "，", "。",
		str_replace( "！", "。",
		str_replace( "：", "。",
		str_replace( "；", "。",
		str_replace( "、", "。",
		str_replace( "《", "",   // remove these
		str_replace( "》", "",
		str_replace( "〈", "",
		str_replace( "〉", "",
		str_replace( "「", "",
		str_replace( "」", "",
		str_replace( "『", "",
		str_replace( "』", "",
		str_replace( "·", "",
		str_replace( "　", "",
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
		))))))))))))))))))))))))))))))))))));  
	$text = preg_replace( '/[\d]+ [\P{M}]+?\n/', "", $text );
	$text = preg_replace( '/[\s]+/', "", $text );
	
	if( $removePunctuation )
	{
		$text = str_replace( "。", "", $text );
	}

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

// 去掉頁碼, garbage in, garbage out
function 提取簡化坐標( string $坐標 ) : string
{
	$str = trim( $坐標, 坐標括號 );
	$str_array = explode( ':', $str );

	if( strlen( $str_array[ 0 ] ) !== 4 ) // no 頁碼
	{
		return $坐標;
	}
	return 坐標開括號 .
		substr( implode( ':', $str_array ), 5 ) .
		坐標關括號;
}

// 提取頁碼,〚 後面的四個數字, garbage in, garbage out
function 提取頁碼( string $坐標 ) : string
{
	$str = trim( $坐標, 坐標括號 );
	$str_array = explode( ':', $str );
	// 至少有兩塊
	if( sizeof( $str_array ) < 2 ||
		strlen( $str_array[ 0 ] ) !== 4 )
	{
		return $坐標;
	}
	return $str_array[ 0 ];
}

// 提取首碼, 1-20, garbage in, garbage out
function 提取首碼( string $坐標 ) : string
{
	$str = trim( $坐標, 坐標括號 );
	$str_array = explode( ':', $str );
	//print_r( $str_array );
	if( sizeof( $str_array ) == 3 && // 有頁碼
		( intval( $str_array[ 1 ] ) > 0 &&
		  intval( $str_array[ 1 ] ) < 21 ) &&
		strlen( $str_array[ 0 ] ) === 4 )
	{
		return $str_array[ 1 ];
	}
	elseif( sizeof( $str_array ) == 2 && // 沒有頁碼
		( intval( $str_array[ 0 ] ) > 0 &&
		  intval( $str_array[ 0 ] ) < 21 ))
	{
		return $str_array[ 0 ];
	}
	return $坐標;
}

function 生成完整坐標( string $坐標, string $頁碼 ) : string
{
	$str = trim( $坐標, 坐標括號 );
	$str_array = explode( ':', $str );
	
	if( 
		( sizeof( $str_array ) === 2 || 
			sizeof( $str_array ) === 3 )
		&&
		strlen( $str_array[ 0 ] ) === 4 ) // 頁碼 already there
	{
		return $坐標;
	}
	
	if( strlen( $頁碼 ) !== 4 ) // no 頁碼 supplied
	{
		return $坐標;
	}
	
	if( ( sizeof( $str_array ) === 2 &&
		intval( $str_array[ 0 ] ) > 0 &&
		intval( $str_array[ 0 ] ) < 21 ) ||
		sizeof( $str_array ) === 1 )
	{
		return 
			坐標開括號 . $頁碼 . ':' . 
			implode( ':', $str_array ) .
			坐標關括號;
	}
}

function 提取版本詩文( string $版本, string $頁 ) : array
{
	require( "h:\\github\\Dufu-Analysis\\坐標_詩句.php" );
	global $書目簡稱;
	//global $坐標_詩句;
	global $頁碼_詩題;
	global $頁碼_路徑;
	global $詩組_詩題;
	
	// 讀取想要版本的異文、夾注
	$section = getSection( $頁碼_路徑[ $頁 ], $版本 );
	$版本異文、夾注 = array();
	$in_異文、夾注 = false;
	$坐標版本異文、夾注 = array();
	
	foreach( $section as $l )
	{
		if( mb_strpos( $l, "【異文、夾注】" ) !== false )
		{
			$in_異文、夾注 = true;
			continue;
		}
		elseif( $in_異文、夾注 && trim( $l ) === "" )
		{
			$in_異文、夾注 = false;
			break;
		}
		//
		if( $in_異文、夾注 )
		{
			if( mb_strpos( $l, '〛' ) !== false )
			{
				$parts = explode( '〛', $l );
				$版本異文、夾注[ '〚' . $頁 . ':' . 
					trim( $parts[ 0 ], '〚' ) .
					'〛' ] = $parts[ 1 ];
			}
			elseif( mb_strpos( $l, '〗' ) !== false )
			{
				$parts = explode( '〗', $l );
				
				if( $頁 == "3955" )
				{
					//print_r( $parts );
				}
				
				$默認詩文 = mb_substr( $parts[ 0 ], 1 );
				$坐標 = 提取〖詩文〗坐標( $parts[ 0 ] . '〗', $頁 );
				$坐標版本異文、夾注[ $坐標 ] = trim( $l );
				$版本異文、夾注[ $坐標 ] = 
					array( $默認詩文, $parts[ 1 ] );
			}
		}
	}
	
	$版本陣列 = array();
	// 讀取默認版本
	$詩文路徑 = 詩集文件夾 . "\\" . $頁 . '.php';
	require( $詩文路徑 );
	
	if( !array_key_exists( $頁, $詩組_詩題 ) )
	{
		$版本詩文 = $内容[ "詩文" ];
	}
	else
	{
		$版本詩文 = $内容[ "詩歌" ];
		$新版本詩文 = array();
				
		foreach( $版本詩文 as $題 => $列陣 )
		{
			$副詩 = normalize( implode( $列陣 ) );
			array_push( $新版本詩文, $副詩 );
		}
		$版本詩文 = $新版本詩文;

	}
	
	// 讀取默認版本的坐標_用字
	//$坐標_用字路徑 = 詩集文件夾 . "\\" . $頁 . '坐標_用字.php';
	//require( $坐標_用字路徑 );
					
	// 以想要版本的異文、夾注，代替默認版本相對應的用字
	foreach( $版本異文、夾注 as $異文、夾注坐標 => $異文、夾注 )
	{
		if( $異文、夾注坐標 == "" )
		{
			continue;
		}
		elseif( $異文、夾注坐標 == "〚${頁}:1〛" )
		{
			//〖1〗
			$版本陣列[ "詩題" ] = trim( $異文、夾注[ 1 ] );
			continue; 
		}
		elseif( $異文、夾注坐標 == "〚${頁}:3〛" )
		{
			//〖3〗
			$版本陣列[ "詩序" ] = trim( $異文、夾注[ 1 ] );
			continue; 
		}		
		else
		{
			if( !array_key_exists( $頁, $詩組_詩題 ) )
			{
				$版本詩文 = str_replace(
					trim( $異文、夾注[ 0 ] ),
					trim( $異文、夾注[ 1 ] ),
					$版本詩文 );
			}
			else
			{
				$新版本詩文 = array();
				
				foreach( $版本詩文 as $副詩 )
				{
					$副詩 = str_replace(
						trim( $異文、夾注[ 0 ] ),
						trim( $異文、夾注[ 1 ] ),
						$副詩 );
					array_push( $新版本詩文, $副詩 );
				}
				$版本詩文 = $新版本詩文;
				//print_r( $版本詩文 );
				//exit;
			}
		}
	}
	
	$版本陣列[ "詩文" ] = $版本詩文;
	$版本陣列[ "坐標版本異文、夾注" ] = $坐標版本異文、夾注;
	
	//print_r( $版本陣列 );
	return $版本陣列;
}
function 提取〖詩文〗坐標( string $〖詩文〗, string $頁 ) : string
{
	if( intval( trim( $〖詩文〗, '〖〗' ) ) > 0 )
	{
		return "〚" . $頁 . ':' .
			trim( $〖詩文〗, '〖〗' ) . "〛";
	}

	require( 詩集文件夾 . "${頁}.php" );
	$詩文 = trim( $〖詩文〗, '〖〗' );
	$空坐標 = "";
	$句坐標 = "";
	$詩文位置 = -1;
	
	foreach( $内容[ "坐標_句" ] as $坐標 => $句 )
	{
		$詩文位置 = mb_strpos( $句, $詩文 ); // 0 based
		
		if( $詩文位置 !== false )
		{
			$句坐標 = $坐標;
			// discount the brackets: - 2
			if( mb_strlen( $〖詩文〗 ) - 2 > 1 )
			{
				$詩文位置 = "." . $詩文位置+1 . "-" . 
					$詩文位置+1 + mb_strlen( $〖詩文〗 ) - 3;
			}
			else
			{
				$詩文位置 = "." . $詩文位置 + 1;
			}
			$句坐標 = '〚' . trim( $句坐標, '〛' ) . 
				$詩文位置 . '〛';
			// get rid of sth invisible
			$句坐標 = "〚" . trim( $句坐標, "〚〛" ) . "〛";

			return $句坐標;
		}
	}
	
	return $空坐標;
}
?>