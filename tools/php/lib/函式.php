<?php
/*
函式

*/
set_error_handler( function ( 
	$severity, $message, $file, $line )
{
    throw new \ErrorException( $message, $severity, 	
		$severity, $file, $line );
});

// load constants
require_once( __DIR__ . DIRECTORY_SEPARATOR . '常數.php' );
define( 'PHP_CODE_BASE_DIR', dirname( __DIR__ ) . DS );
define( 'PHP_FUNCTIONS_DIR', PHP_CODE_BASE_LIB_DIR . FUNCTIONS_DIR );
define( 'PHP_EXCEPTIONS_DIR', PHP_CODE_BASE_LIB_DIR . EXCEPTIONS_DIR );
define( 'JSON_DATA_LOADER',
	PHP_CODE_BASE_LIB_DIR . 'JsonDataLoader.class.php' );

define( 'JSON_BASE_DIR', dirname( __DIR__, 3 ) . DS .
	'schemas' . DS . 'json' . DS );

// load functions
$func_dir = __DIR__ . DS . FUNCTIONS_DIR;

if( ! is_dir( $func_dir ) )
{
    throw new RuntimeException( '函式目錄不存在: ' . $func_dir );
}
$files = scandir( $func_dir );
sort( $files, SORT_STRING );

foreach( $files as $file )
{
	$path = $func_dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\.php$/i', $file )
	)
	{
		require_once( $path );
	}
}


// load exceptions
$excep_dir = __DIR__ . DS . EXCEPTIONS_DIR;
if( ! is_dir( $excep_dir ) )
{
    throw new RuntimeException( 'exceptions 目錄不存在: ' . $excep_dir );
}
$files = scandir( $excep_dir );
sort( $files, SORT_STRING );

foreach( $files as $file )
{
	$path = $excep_dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\.class\.php$/i', $file )
	)
	{
		require_once( $path );
	}
}

// load json loader
if( ! is_file( JSON_DATA_LOADER ) )
{
    throw new RuntimeException( 'JsonDataLoader 未找到: ' . JSON_DATA_LOADER );
}
require_once( JSON_DATA_LOADER );
$DATA = new JsonDataLoader( JSON_BASE_DIR );









require_once( 杜甫資料庫 . '異體字.php' );

$path_for_file = '';
$text_of_file  = '';

// check argv
function checkARGV( array $argv, int $num, string $msg )
{
	if( sizeof( $argv ) != $num )
	{
		echo $msg, NL;
		exit;
	}
}

// 比較兩段文字。如果字數不同，不比較。
function compareText(
	string $text1,
	string $text2,
	bool $removePunctuation = false ) : array
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


// 提取題注（杜甫原注）
// $file_path: h:\github\DuFu\01 卷一 3-270\0048 過宋員外之問舊莊.txt
/*
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
*/

// given 〚0013:1:5-6〛, returns array containing
// 〚0013:1:5〛,〚0013:1:6〛
// only expands 行碼
// 只接受完整坐標
function 提取擴充行碼坐標( string $坐標 ) : array
{
	if( 是完整坐標( $坐標 ) === false )
	{
		return array( "不是完整坐標。" );
	}
	$regex1 = '/\d{4}:\d+-\d+/'; // 〚0003:5.1-4〛
	$regex2 = '/\d{4}:\d+:\d+-\d+/'; // 〚0013:2:11-13〛
	$裸坐標 = str_replace( '〚', '', 
		str_replace( '〛', '', $坐標 ) );
	$match = array();
	
	$r = preg_match( $regex1, $裸坐標, $match );
	if( !$r || $match[ 0 ] != $裸坐標 )
	{
		$match = array();
		$r = preg_match( $regex2, $裸坐標, $match );
		if( !$r || $match[ 0 ] != $裸坐標 )
		{
			return array( "字碼沒有範圍數字。" );
		}
	}
	// $parts[2], the last part
	$parts = explode( '.', $裸坐標 );
	$last = $parts[ 2 ];
	$first = $parts[ 0 ] . '.' . $parts[ 1 ] . '.';
	
	$坐標陣列 = array();
	$pre_parts = "";
	$行範圍 = explode( '-', $last );
	
	if( intval( $行範圍[ 0 ] ) >= 
		intval( $行範圍[ 1 ] ) )
	{
		return array( "字碼範圍數字不合規範。" );
	}
	$字碼範圍陣列 = 
		range( intval( $行範圍[ 0 ] ), intval( $行範圍[ 1 ] ) );
	
	foreach( $字碼範圍陣列 as $字碼 )
	{
		array_push(
			$坐標陣列,
			'〚' . $first . $字碼 . '〛' );
	}
			
	return $坐標陣列;
}


// given 〚0013:1:5.2.3-4〛, returns array containing
// 〚0013:1:5.2.3〛,〚0013:1:5.2.4〛
// only expands 字碼
// 只接受完整坐標
function 提取擴充字碼坐標( string $坐標 ) : array
{
	if( 是完整坐標( $坐標 ) === false )
	{
		return array( "不是完整坐標。" );
	}
	$regex1 = '/\d{4}:\d+\.\d.\d+-\d+/'; // 〚0003:5.1.2-4〛
	$regex2 = '/\d{4}:\d+:\d+\.\d.\d+-\d+/'; // 〚0013:2:11.2.1-3〛
	$裸坐標 = str_replace( '〚', '', 
		str_replace( '〛', '', $坐標 ) );
	$match = array();
	
	$r = preg_match( $regex1, $裸坐標, $match );
	if( !$r || $match[ 0 ] != $裸坐標 )
	{
		$match = array();
		$r = preg_match( $regex2, $裸坐標, $match );
		if( !$r || $match[ 0 ] != $裸坐標 )
		{
			return array( "字碼沒有範圍數字。" );
		}
	}
	// $parts[2], the last part
	$parts = explode( '.', $裸坐標 );
	$last = $parts[ 2 ];
	$first = $parts[ 0 ] . '.' . $parts[ 1 ] . '.';
	
	$坐標陣列 = array();
	$pre_parts = "";
	$行範圍 = explode( '-', $last );
	
	if( intval( $行範圍[ 0 ] ) >= 
		intval( $行範圍[ 1 ] ) )
	{
		return array( "字碼範圍數字不合規範。" );
	}
	$字碼範圍陣列 = 
		range( intval( $行範圍[ 0 ] ), intval( $行範圍[ 1 ] ) );
	
	foreach( $字碼範圍陣列 as $字碼 )
	{
		array_push(
			$坐標陣列,
			'〚' . $first . $字碼 . '〛' );
	}
			
	return $坐標陣列;
}

// gets the file contents
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

// add a line to the end of a file
function logToFile( string $file, string $content )
{
	file_put_contents(
		$file, 
		$content.PHP_EOL, 
		FILE_APPEND | LOCK_EX );
}

function normalize(
	string $text,
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
	//echo $text;
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
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
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
	$坐標regex = '/〚\d{4}:/';
	$match = array();
	$r = preg_match( $坐標regex, $坐標 );
	if( !$r )
	{
		return "${坐標} 不是完整坐標。";
	}
	//$str = trim( $坐標, 坐標括號 );
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );

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
	//$str = trim( $坐標, 坐標括號 );
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );

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
	return '';
}

// 提取行碼, garbage in, garbage out
// 〚0013:1:5.2.3-4〛
function 提取行碼( string $坐標 ) : string
{
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
	$str_array = explode( '.', $str );
	
	if( sizeof( $str_array ) >= 1 ) 
	{
		if( strpos( $str_array[ 0 ], ':' ) !== false )// 有頁碼
		{
			$parts = explode( ':', $str_array[ 0 ] );
			
			if( sizeof( $parts ) == 2 ) // 沒有首碼
			{
				return $parts[ 1 ];
			}
			elseif( sizeof( $parts ) == 3 ) // 有首碼
			{
				return $parts[ 2 ];
			}
		}
		else // 沒有頁碼，沒有首碼
		{
			return $str_array[ 0 ];
		}
	}
	return '';
}

// 提取句碼, garbage in, garbage out
function 提取句碼( string $坐標 ) : string
{
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
	$str_array = explode( '.', $str );
	
	if( sizeof( $str_array ) >= 2 )
	{
		return $str_array[ 1 ];
	}
	return '';
}

// 提取字碼, garbage in, garbage out
function 提取字碼( string $坐標 ) : string
{
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
	$str_array = explode( '.', $str );
	
	if( sizeof( $str_array ) >= 3 )
	{
		return $str_array[ 2 ];
	}
	return '';
}

function 生成完整坐標( string $坐標, string $頁碼 ) : string
{
	//$str = trim( $坐標, 坐標括號 );
	$str = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );

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

function 提取詩文陣列( string $頁碼 ) : array
{
	global $頁碼_詩題;
	global $詩組_詩題;
	$默認路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
	require( $默認路徑 );
	
	// get poem
	$詩文内容 = $内容[ 行碼 ];
	// remove page number
	$詩文内容[ '〚1〛' ] = preg_replace( '/\d{4}/', '', $詩文内容[ '〚1〛' ] );
	// insert 副題
	if( array_key_exists( $頁碼, $詩組_詩題 ) )
	{
		$副題s = $内容[ 副題 ];
		$副題行碼 = $詩組_詩題[ $頁碼 ][ 1 ];
		$index = 1;
		
		foreach( $副題行碼 as $行碼 )
		{
			$詩文内容[ "〚${行碼}〛" ] = $副題s[ "〚${頁碼}:${index}:〛" ];
			$index++;
		}
	}
	return $詩文内容;
}

// $詩文: 2-5字
function 提取詩文末字坐標( string $頁碼, string $詩文, $保留頁碼 = false ) : string
{
	global $二字組合_坐標;
	global $三字組合_坐標;
	global $四字組合_坐標;
	global $五字組合_坐標;
	
	if( mb_strpos( $詩文, 坐標開括號 ) !== false )
	{
		return 生成完整坐標( $詩文, $頁碼 );
	}
	$current = array();
	$坐標s = array();
	$坐 = '';
	$字數 = mb_strlen( $詩文 );
	switch( $字數 )
	{
		case 2:
			$current = $二字組合_坐標;
			break;
		case 3:
			$current = $三字組合_坐標;
			break;
		case 4:
			$current = $四字組合_坐標;
			break;
		case 5:
			$current = $五字組合_坐標;
			break;
	}
	if( array_key_exists( $詩文, $current ) )
	{
		$坐標s = $current[ $詩文 ];
	}
	if( sizeof( $坐標s ) > 0 )
	{
		foreach( $坐標s as $坐標 )
		{
			if( 提取頁碼( $坐標 ) == $頁碼 )
			{
				$坐 = $坐標;
			}
		}
	}
	if( $坐 != '' )
	{
		$坐 = preg_replace( '/\d-/', '', $坐 );
		if( !$保留頁碼 )
		{
			$坐 = 
				preg_replace( '/\d{4}:/', '', $坐 );
		}
	}
	
	return $坐;
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
					str_replace( '〚', '', $parts[ 0 ] ) .
					//trim( $parts[ 0 ], '〚' ) .
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
				
				if( $頁 == "3955" )
				{
					//echo 'L567 ', $parts[ 0 ] . '〗', NL;
				}
				
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

function 提取版本詩文含夾注陣列( 
	array $詩陣列, 
	array $版本異文、夾注, 
	array $版本注釋,
	bool $加句號 = true, 
	bool $加新行 = true ) : array
{
	$首碼 = '';
	$是詩組 = array_key_exists( '1', $詩陣列 );
	$題碼 = '';
	
	foreach( $版本異文、夾注 as $key => $value )
	{
		$頁碼 = 提取頁碼( $key );
		if( $頁碼 != '' )
		{
			$題碼 = "〚{$頁碼}:1〛";
			break;
		}
	}

	foreach( $版本異文、夾注 as $key => $value )
	{
		if( $key == $題碼 )
		{
			$詩陣列[ '詩題' ] = $value;
			continue;
		}
		
		//echo $value, NL;
		$異文、夾注 = trim( explode( '〗', $value )[ 1 ] );
		$首碼 = 提取首碼( $key );
		
		if( !$是詩組 && $首碼 == '' )
		{
			$首碼 = '1';
		}
		$行碼 = 提取行碼( $key );
		$句碼 = 提取句碼( $key );
		$異文、夾注陣列 = 分割異文、夾注( $異文、夾注 );
		
		if( !$是詩組 && $首碼 == '1' )
		{
			foreach( $異文、夾注陣列 as $字碼 => $字 )
			{
				$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] = $字;
			}
		}
		elseif( $是詩組 )
		{
			foreach( $異文、夾注陣列 as $字碼 => $字 )
			{
				$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] = $字;
			}
		}
	}
	
	//print_r( $詩陣列 );
	$counter = 1;
	
	//foreach( $詩陣列 as $key => 
	foreach( $版本注釋 as $key => $value )
	{
		/*
		if( $首碼 != '1' )
		{
			$詩陣列 = $詩陣列[ $首碼 ];
		}
		*/
		$首碼 = 提取首碼( $key );
		$行碼 = 提取行碼( $key );
		$句碼 = 提取句碼( $key );
		$字碼 = 提取字碼( $key );
		//echo "行碼 $行碼", NL;
		//echo "句碼 $句碼", NL;
		//echo "字碼 $字碼", NL;
		// no 字碼
		try
		{
			if( $首碼 == '' && $行碼 != '' && $句碼 != '' && $字碼 == '' )
			{
				$字碼 = sizeof( $詩陣列[ $行碼 ][ $句碼 ] );
			}
			elseif( $首碼 != '' && $行碼 != '' && $句碼 != '' && $字碼 == '' )
			{
				$字碼 = sizeof( $詩陣列[ $首碼 ][ $行碼 ][ $句碼 ] );
			}
		}
		catch( ErrorException $e )
		{
			print_r( $詩陣列 );
			echo $key, NL;
			echo "行碼 $行碼", NL;
			echo "句碼 $句碼", NL;
			echo "字碼 $字碼", NL;

			echo $e, NL;
			
		}
		
		if( $行碼 == '1' )
		{
			continue;
		}
		if( mb_strpos( $字碼, '-' ) !== false )
		{
			$parts = explode( '-', $字碼 );
			$字碼 = trim( $parts[ sizeof( $parts ) - 1 ] );
			//echo $字碼, NL;
		}
		if( !$是詩組 )
		{
			
			$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] =
				$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] . '[' . $counter . ']';
		}
		else
		{
			$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] =
				$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] . 
				'[' . $counter . ']';
		}
		$counter++;
	}
	$result = $詩陣列;
	if( array_key_exists( '詩題', $result ) )
	{
		$result[ '詩題' ] = '';
	}
	if( !$是詩組 )
	{
		$result[ '1' ] = $詩陣列;
	}
	//print_r( $result );
	return $result;
}

function 提取版本詩文含夾注( 
	array $詩陣列, 
	array $版本異文、夾注, 
	array $版本注釋,
	bool $加句號 = true, 
	bool $加新行 = true ) : string
{
	$result = 提取版本詩文含夾注陣列( $詩陣列, $版本異文、夾注, $版本注釋, $加句號, $加新行 );
	return 提取杜甫詩陣列詩文( $result, $加句號, $加新行 );
}

// $〖詩文〗中第一字坐標
function 提取〖詩文〗坐標( string $〖詩文〗, string $頁 ) : string
{
	$str = str_replace( '〛', '', str_replace( '〚', '', $〖詩文〗 ) );
	
	//if( intval( trim( $〖詩文〗, '〖〗' ) ) > 0 )
	if( intval( $str ) > 0 )
	{
		return "〚" . $頁 . ':' .
			//trim( $〖詩文〗, '〖〗' ) . "〛";
			$str . "〛";
	}

	require( 詩集文件夾 . "${頁}.php" );
	//$詩文 = trim( $〖詩文〗, '〖〗' );
	$詩文 = str_replace( '〗', '', str_replace( '〖', '', $〖詩文〗 ) );
if( $頁 == '3955' )
{
	//echo $詩文, NL;
}
	$空坐標 = "";
	$句坐標 = "";
	$詩文位置 = -1;
	
	if( preg_match( '|^\d+|', $詩文 ) )
	{
		return "〚${頁}:${詩文}〛";
	}
	
	foreach( $内容[ "坐標_句" ] as $坐標 => $句 )
	{
		$詩文位置 = mb_strpos( $句, $詩文 ); // 0 based
		
if( $頁 == '3955' )
{
	//echo $詩文, ' ', $句, NL;
}
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
			//$句坐標 = '〚' . trim( $句坐標, '〛' ) . 
			$句坐標 = '〚' . 
				//trim( $句坐標, '〛' ) .
				str_replace( '〛', '', $句坐標 ) .
				$詩文位置 . '〛';
			// get rid of sth invisible
			$句坐標 = "〚" . trim( $句坐標, "〚〛" ) . "〛";

			return $句坐標;
		}
		else
		{
			//return $空坐標;
		}
		//
	}
	
	return $空坐標;
}

function 分割異文、夾注( string $異文、夾注 ) : array
{
	$净文 = 移除詩文夾注( $異文、夾注 );
	$净文len = mb_strlen( $净文 );
	$result = array();
	$store = '';
	$異文len = mb_strlen( $異文、夾注 );
	$inbracket = false;
	$current_index = 0;
	
	for( $i = 1; $i<=$異文len; $i++ )
	{
		$current_char = mb_substr( $異文、夾注, $i-1, 1 );
		
		if( $current_char == '['  )
		{
			$inbracket = true;
			$result[ "$current_index" ] = 
				$result[ "$current_index" ] . $current_char;
		}
		elseif( $current_char == ']' )
		{
			$inbracket = false;
			$result[ "$current_index" ] = 
				$result[ "$current_index" ] . $current_char;
		}
		elseif( $inbracket )
		{
			$result[ "$current_index" ] = 
				$result[ "$current_index" ] . $current_char;
		}
		else
		{
			$current_index++;
			$result[ "$current_index" ] = $current_char;
		}
	}
	//echo "From 分割異文、夾注: ", NL;
	//print_r( $result );
	return $result;
}

function containsPronunciation( string $haystack, string $needle ) : bool
{
	if( strpos( $haystack, '/' ) === false )
	{
		if( $haystack == $needle || // identical
			strpos( $haystack, $needle ) !== false ) // proper subset
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		$hs = explode( ' ', $haystack );
		$temp = array( array(), array() );
		
		foreach( $hs as $h )
		{
			if( strpos( $h, '/' ) === false )
			{
				array_push( $temp[ 0 ], $h );
				array_push( $temp[ 1 ], $h );
			}
			else
			{
				$ps = explode( '/', $h );
				array_push( $temp[ 0 ], $ps[ 0 ] );
				array_push( $temp[ 1 ], $ps[ 1 ] );
			}
		}
		$h1 = implode( ' ', $temp[ 0 ] );
		$h2 = implode( ' ', $temp[ 1 ] );
		
		if( containsPronunciation( $h1, $needle ) ||
			containsPronunciation( $h2, $needle ) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
// 坐標必須是完整坐標
function 提取詩句( string $坐標 ) : string
{
	$頁碼 = 提取頁碼( $坐標 );
	//$首碼 = 提取首碼( $坐標 );
	$行碼 = 提取行碼( $坐標 );
	$句碼 = 提取句碼( $坐標 );
	
	if( $頁碼 == '' )
	{
		return '';
	}
	if( $行碼 == '' )
	{
		return '';
	}
	if( $句碼 == '' )
	{
		return '';
	}
	require_once( 詩集文件夾 . $頁碼 . 程式後綴 );
	
	if( array_key_exists( $坐標, $内容[ 坐標_句 ] ) )
	{
		return $内容[ 坐標_句 ][ $坐標 ];
	}
	return '';
}

// $句坐標、$詞組坐標 必須是完整坐標
function 在句中( string $句坐標, string $詞組坐標 ) : bool
{
	$句 = 提取詩句( $句坐標 );
	$詞組 = 提取詩文( $詞組坐標 );
	
	if( mb_strpos( $句, $詞組 ) !== false )
	{
		return true;
	}
	return false;
}

// $坐標 必須是完整坐標，必須有字碼
function 提取詩文( string $坐標 ) : string
{
	$詩文頁碼 = 提取頁碼( $坐標 );
	$詩文首碼 = 提取首碼( $坐標 );
	$詩文行碼 = 提取行碼( $坐標 );
	$詩文句碼 = 提取句碼( $坐標 );
	$詩文字碼 = 提取字碼( $坐標 );
	
	if( $詩文頁碼 == '' || $詩文行碼 == '' || $詩文句碼 == '' || $詩文字碼 == '' )
	{
		return '';
	}
	// range
	if( strpos( $詩文字碼, '-' ) !== false )
	{
		$字碼陣列 = explode( '-', $詩文字碼 );
		
		if( intval( $字碼陣列[ 0 ] ) >= intval( $字碼陣列[ 1 ] ) )
		{
			return '';
		}
		$字數 = intval( $字碼陣列[ 1 ] ) - intval( $字碼陣列[ 0 ] ) + 1 ;
	}
	else
	{
		$字數 = 1;
	}
		
	if( $字數 == 1 )
	{
		require_once( 詩集文件夾 . $詩文頁碼 . '坐標_用字' . 程式後綴 );
		return $坐標_用字[ $坐標 ];
	}
	elseif( $字數 > 1 && $字數 < 6 ) // 2 to 5
	{
		$文檔名 = '';
		switch( $字數 )
		{
			case 2:
				$文檔名 = '二字組合_坐標';
				break;
			case 3:
				$文檔名 = '三字組合_坐標';
				break;
			case 4:
				$文檔名 = '四字組合_坐標';
				break;
			case 5:
				$文檔名 = '五字組合_坐標';
				break;
		}
		if( $文檔名 != '' )
		{
			//echo $文檔名, NL;
			require_once( 杜甫資料庫 . $文檔名 . 程式後綴 );
			
			foreach( $$文檔名 as $組合 => $坐標陣列 )
			{
				if( in_array( $坐標, $坐標陣列 ) )
				{
					return $組合;
				}
			}
		}
		else
		{
			return '';
		}
	}

	return '';
}

function 移除詩文夾注( string $帶夾注詩文 ) : string
{
	return preg_replace( 夾注regex, '', $帶夾注詩文 );
}

function format詩文( string $詩文 ) : string
{
	return preg_replace( 四句regex, 第一組新行regex, $詩文 );
}

function 提取陣列値( array $陣列 ) : string
{
	$str = '';
	foreach( $陣列 as $k => $v )
	{
		$str .= $v;
	}
	return $str;
}

// 完整坐標，其中不能有 - 
function 坐標轉換成列陣路徑( string $坐標 ) : array
{
	// remove brackets
	$坐標 = str_replace( 坐標開括號, '', 
			str_replace( 坐標關括號, '', $坐標 ) );
	// hyphen only
	$坐標 = str_replace( ':', '-', $坐標 );
	$坐標 = str_replace( '.', '-', $坐標 );
	
	return explode( '-', trim( $坐標, ' -' ) );
}

// 〚0276:20.2.2-4〛
function 範圍字碼坐標轉換成列陣路徑( string $坐標 ): array
{
	$temp = array();
	$result = array();
	$match = array();
	$範圍_regex = '/\.([\d+])-([\d+])/';
	
	$r = preg_match_all( $範圍_regex, "〚0276:20.2.2-4〛",
		$match );
	if( $r && sizeof( $match ) > 2 )
	{
		//print_r( $match );
		$字碼s = range( 
			intval( $match[ 1 ][ 0 ] ), 
			intval( $match[ 2 ][ 0 ] ) );
		foreach( $字碼s as $字碼 )
		{
			array_push( $temp,
				str_replace( $match[ 0 ][ 0 ],
				'.' . $字碼, $坐標 ) );
		}
	}
	return $temp;
}

function 顯示坐標值( array $杜甫詩陣列, string $坐標 ) 
{
	$路徑 = 坐標轉換成列陣路徑( $坐標 );
	
	if( sizeof( $路徑 ) == 4 )
	{
		$值 = $杜甫詩陣列[ $路徑[ 0 ] ]
			[ $路徑[ 1 ] ]
			[ $路徑[ 2 ] ]
			[ $路徑[ 3 ] ];
	}
	elseif( sizeof( $路徑 ) == 3 )
	{
		$值 = $杜甫詩陣列[ $路徑[ 0 ] ]
			[ $路徑[ 1 ] ]
			[ $路徑[ 2 ] ];
	}
	elseif( sizeof( $路徑 ) == 2 )
	{
		$值 = $杜甫詩陣列[ $路徑[ 0 ] ]
			[ $路徑[ 1 ] ];
	}
	elseif( sizeof( $路徑 ) == 1 )
	{
		$值 = $杜甫詩陣列[ $路徑[ 0 ] ];
	}
	
	print_r( $值 );
}

// 必須包括首碼
function 提取杜甫詩陣列詩文( array $詩文陣列, 
	bool $加句號 = true,
	bool $加新行 = true ) : string
{
	$contents = '';
	
	foreach( $詩文陣列 as $首碼 => $行子陣列 )
	{
		if( is_string( $行子陣列 ) )
		{
			//echo $首碼, NL;
			continue;
		}
		
		foreach( $行子陣列 as $句碼 => $句子陣列 )
		{
			//print_r( $句子陣列 );
			if( is_string( $句子陣列 ) )
			{
				if( sizeof( $詩文陣列 ) > 1 )
				{
					$contents .= $句子陣列 . NL;
				}
				continue;
			}
			$行文 = '';
			
			//print_r( $句子陣列 );
			
			foreach( $句子陣列 as $字碼 => $字子陣列 )
			{
				$句文 = '';
				
				if( is_array( $字子陣列 ) )
				{
					foreach( $字子陣列 as $字碼 => $字 )
					{
						$句文 .= $字;
					}
					if( $加句號 )
					{
						$句文 .= '。';
					}
				}
				$行文 .= $句文;
			}
			$contents .=  $行文;
			if( $加新行 )
			{
				$contents .= NL;
			}
		}
	}
	return $contents;
}

function 顯示杜甫詩陣列詩文( 
	array $詩組_詩題, string $頁碼,
	array $頁列陣, bool $加句號 = true, bool $加新行 = true )
{
	$result = array();
	// 首
	if( in_array( $頁碼, array_keys( $詩組_詩題 ) ) )
	{
		$result = $頁列陣;
	}
	else
	{
		$result[ '1' ] = $頁列陣;
	}
	
	if( array_key_exists( 詩題, $頁列陣 ) )
	{
		echo $頁列陣[ 詩題 ];
	}
	if( array_key_exists( 題注, $頁列陣 ) )
	{
		echo '[', $頁列陣[ 題注 ], ']', NL;
	}
	else
	{
		echo NL;
	}
	if( array_key_exists( 序言, $頁列陣 ) )
	{
		echo $頁列陣[ 序言 ], NL;
	}
	
	foreach( $result as $首碼 => $行子陣列 )
	{
		if( is_string( $行子陣列 ) )
		{
			//echo $首碼, NL;
			continue;
		}
		
		foreach( $行子陣列 as $句碼 => $句子陣列 )
		{
			//print_r( $句子陣列 );
			if( is_string( $句子陣列 ) )
			{
				if( sizeof( $result ) > 1 )
				{
					//echo $句子陣列, NL;
				}
				continue;
			}
			$行文 = '';
			
			foreach( $句子陣列 as $字碼 => $字子陣列 )
			{
				$句文 = '';
				
				foreach( $字子陣列 as $字碼 => $字 )
				{
					$句文 .= $字;
				}
				if( $加句號 )
				{
					if( mb_strlen( $句文 ) == sizeof( $字子陣列 ) )
					{
						$句文 .= '。';
					}
					elseif( intval( $字碼 ) == sizeof( $字子陣列 ) )
					{
						//$句文 = str_replace( '[', '。[', $句文 );
						$句文 .= '。';
					}
				}
				$行文 .= $句文;
			}
			//echo $行文;
			if( $加新行 )
			{
				echo NL;
			}
		}
	}
}

function 杜甫詩陣列句ToString( array $句 ) : string
{
	//print_r( $句 );
	return implode( $句 );
}

function 杜甫詩陣列行ToString(
	array $行, 
	bool $加句號=true, 
	bool $加新行=false, 
	bool $加行碼=false,
 	int $行碼 = 0
) : string
{
	$行内容 = '';
	$句内容 = '';
	//print_r( $行 );
	foreach( $行 as $碼 => $句 )
	{
		if( is_array( $句 ) )
		{
			//echo "array", NL;
			$句内容 = implode( $句 );
			//echo '句内容' . $句内容, NL;
		}
		//print_r( $句 );
		
		/*
		foreach( $句s as $句 )
		{
			if( is_array( $句 ) )
			{
				$句内容 .= 杜甫詩陣列句ToString( $句 );
				
			}
		}
		*/
		if( $加句號 ){ $句内容 .= '。'; }
		if( $加新行 )
		{ 
			if( $碼 == sizeof( $行 ) )
			{
				$句内容 .= NL;
			}
		}
		if( $加行碼 )
		{ 
			// 行碼 available only in a new line
			if( intval( $行碼 ) != 0 && $加新行 && $碼 != sizeof( $行 ) )
			{
				$句内容 = "〚${行碼}〛" . $句内容;
			}
		}
		$行内容 .= $句内容;
	}
	return $行内容;
}

function 杜甫詩陣列首ToString(
	array $首,
	bool $加句號=true, 
	bool $加新行=false, 
	bool $加行碼=false,
	bool $加詩題等=false
) : string
{
	//echo "Printing from 杜甫詩陣列首ToString", NL;
	//print_r( $首 );
	$首内容 = '';
	foreach( $首 as $行碼 => $行 )
	{
		if( $行碼 == 1 || is_string( $行 ) ) // skip 詩題、副題、序文
		{
			if( $加詩題等 )
			{
				$首内容 .= $行 . NL;
			}
			continue;
		}
		$首内容 .= 杜甫詩陣列行ToString( $行, $加句號, $加新行, $加行碼, $行碼 );
	}
	return $首内容;
}

function 杜甫詩陣列行至行ToString(
	array $首,
	string $行至行,
	bool $加句號=true, 
	bool $加新行=false, 
	bool $加行碼=false,
) : string
{
	//print_r( $首 );
	//echo $行至行, NL;
	if( mb_strpos( $行至行, '〚' ) === false ||
		mb_strpos( $行至行, '〛' ) === false )
	{
		return '';
	}
	$行至行 = str_replace( '〚', '', 
		str_replace( '〛', '', $行至行 ) );
	$行至行 = explode( ':', $行至行 )[ 1 ];
	if( strpos( $行至行, '-' ) !== false )
	{
		$範圍 = explode( '-', $行至行 );
		$起 = intval( $範圍[ 0 ] );
		$止 = intval( $範圍[ 1 ] );
	}
	else
	{
		$起 = intval( $行至行 );
		//echo "杜甫詩陣列行至行ToString: ", $起, NL;
		$止 = intval( $行至行 );
	}

	$行至行内容 = '';
	
	foreach( $首 as $行碼 => $行 )
	{
		//echo $行碼, NL;
		//print_r( $行 );
		if( is_string( $行 ) ) // skip 詩題、副題、序文
		{
			//echo $行,  NL;
			continue;
		}
		if( intval( $行碼 ) < $起 || intval( $行碼 ) > $止 )
		{
			//echo "Should see sth $行碼", NL;
			continue;
		}
		//print_r( $行 );
		//echo 杜甫詩陣列行ToString( $行, $加句號, $加新行, $加行碼, $行碼 );
		$行至行内容 .= 杜甫詩陣列行ToString( $行, $加句號, $加新行, $加行碼, $行碼 );
	}
	//echo $行至行内容, NL;
	return $行至行内容;
}

function 杜甫詩陣列詩文替代( array &$頁陣列, array $替代 )
{
	foreach( $替代 as $坐標 => $替代文 ) // $替代文 string
	{
		if( mb_strpos( $坐標, '〚' ) !== false ) // 坐標
		{
			$路徑陣列 = 坐標轉換成列陣路徑( $坐標 );
			
			if( sizeof( $路徑陣列 ) == 3 ) // 行、句、字
			{
				$頁陣列[ $路徑陣列[ 0 ] ]
					[ $路徑陣列[ 1 ] ]
					[ $路徑陣列[ 2 ] ] = $替代文;
			}
			elseif( sizeof( $路徑陣列 ) == 4 )
			{
				$頁陣列[ $路徑陣列[ 0 ] ]
					[ $路徑陣列[ 1 ] ]
					[ $路徑陣列[ 2 ] ] 
					[ $路徑陣列[ 3 ] ] = $替代文;
			}
		}
		elseif( mb_strpos( $坐標, ':' ) !== false ) // 副題 1:
		{
			$parts = explode( ':', $坐標 );
			if( array_key_exists( intval( $parts[ 0 ] ), $頁陣列 ) )
			{
				$頁陣列[ intval( $parts[ 0 ] ) ][ '副題' ] = $替代文;
			}
		}
		else // 詩題 
		{
			$頁陣列[ $坐標 ] = $替代文;
		}
	}
}

function 分割注釋( array $keys, array $版本注釋 ) : array
{
	$result = array();
	$是詩組 = false;
	
	if( in_array( 1, $keys ) )
	{
		$是詩組 = true;
	}
	
	foreach( $keys as $key )
	{
		if( $key == '詩題' || $key == '副題' )
		{
			continue;
		}
		$result[ $key ] = array();
	}
	
	foreach( $版本注釋 as $key => $注釋 )
	{
		// keys are either string or int
		// 詩組
		if( $是詩組 )
		{
			$首碼 = 提取首碼( $key );
			array_push( $result[ $首碼 ], $注釋 );
		}
		else
		{
			$行碼 = 提取行碼( $key );
			//echo "行碼" . $行碼 . NL;
			$坐標s = array_keys( $result );
			
			foreach( $坐標s as $坐標 )
			{
				if( 在行至行範圍内( $坐標, $行碼 ) )
				{
					array_push( $result[ $坐標 ], $注釋 );
					break;
				}
			}
		}	
	}
	
	return $result;
}

function 在行至行範圍内( string $行至行範圍, int $行 ) : bool
{
	//echo "行碼" . $行 . NL;
	//echo "範圍" . $行至行範圍 . NL;
	$行至行範圍 = 
		str_replace( '〚', '', str_replace( '〛', '', $行至行範圍 ) );
	$行至行 = explode( ':', $行至行範圍 )[ 1 ];
	if( strpos( $行至行, '-' ) !== false )
	{
		$行至行 = explode( '-', 提取行碼( $行至行範圍 ) );
		$起 = intval( $行至行[ 0 ] );
		$止 = intval( $行至行[ 1 ] );
	}
	else
	{
		//echo "在行至行範圍内: 行", $行, NL;
		$起 = intval( $行至行 );
		//echo "在行至行範圍内: 起", $起, NL;
		$止 = intval( $行至行 );
		//echo "在行至行範圍内: 止", $止, NL;
		//echo ( $行 >= $起 && $行 <= $止 ) ? "true" : "false", NL;
	}
	//echo "起" . $起 . NL;
	//echo "止" . $止 . NL;
	return ( $行 >= $起 && $行 <= $止 );
}

function fixPageNum( string $num ) : string
{
	$int_num = intval( $num );
	
	if( $int_num > 0 && $int_num < 10 )
	{
		return '000' . $int_num;
	}
	elseif( $int_num > 9 && $int_num < 100 )
	{
		return '00' . $int_num;
	}
	elseif( $int_num > 99 && $int_num < 1000 )
	{
		return '0' . $int_num;
	}
	else
	{
		return $num;
	}
}

function fixText( string $str ) : string
{
	global $異體字;
	$len = mb_strlen( $str );
	$temp = '';
	$ytz = array_keys( $異體字 );
	
	foreach( range( 0, $len - 1 ) as $pos )
	{
		$字 = mb_substr( $str, $pos, 1 );
		
		if( in_array( $字, $ytz ) )
		{
			$temp .= $異體字[ $字 ];
		}
		else
		{
			$temp .= $字;
		}
	}
	return $temp;
}

function getOutput( array $output ) : string
{
	$contents = '';
	foreach( $output as $i => $l )
	{
		$contents .= $l . NL;
	}
	$contents .= NL;
	return $contents;
}

function printOutput( array $output )
{
	echo getOutput( $output );
}

// 用於生成版本文本
function insertText(
	array &$詩陣列, string $坐標, string $文字, bool $replace = false )
{
	// prepare $坐標
	$坐標陣列 = getCoordArray( $坐標 );
	$size = sizeof( $坐標陣列 );
	$字碼 = $坐標陣列[ $size - 1 ];
	$句碼 = $坐標陣列[ $size - 2 ];
	try
	{
		$行碼 = $坐標陣列[ $size - 3 ];
		$首碼 = $坐標陣列[ $size - 4 ]; // possibly $首碼 = $頁碼
	}
	catch( ErrorException $e )
	{
		
	}
	// prepare $文字
	if( mb_strpos( $文字, '〗' ) !== false )
	{
		$文字 = mb_substr( $文字, mb_strpos( $文字, '〗' ) + 1 );
	}
	elseif( mb_strpos( $文字, '：' ) !== false )
	{
		$文字 = '[' . mb_substr( $文字, mb_strpos( $文字, '：' ) + 1 );
	}

	if( !$replace )
	{
		if( $size == 5 )
		{
			$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] =
				$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] . $文字;
		}
		elseif( $size == 4 )
		{
			$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] =
				$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] . $文字;
		}
	}
	else
	{
		if( $size == 5 )
		{
			$詩陣列[ $首碼 ][ $行碼 ][ $句碼 ][ $字碼 ] = $文字;
		}
		elseif( $size == 4 )
		{
			$詩陣列[ $行碼 ][ $句碼 ][ $字碼 ] = $文字;
		}
	}
}

function getCoordArray( string $坐標 ) : array
{
	$hyphen_regex = '/\d-(\d)/';
	$replacement = '$1';
	$temp = preg_replace( $hyphen_regex, $replacement, $坐標 );
	return 坐標轉換成列陣路徑( $temp );
}

function getMergedText( array $詩陣列, string $punc = '' ) : string
{
	$text = '';
	
	foreach( $詩陣列 as $key => $value )
	{
		if( intval( $key ) > 0  && is_string( $value ) )
		{
			$text .= $value;
		}
		elseif( intval( $key ) > 0 && is_array( $value ) )
		{
			$text .= getMergedText( $value, $punc );
		}
	}
	if( mb_substr( $text, mb_strlen( $text ) - 1 ) != $punc )
	{
		$text .= $punc;
	}
	
	if( array_key_exists( '副題', $詩陣列 ) )
	{
		$text = $詩陣列[ '副題' ] . $text;
	}
	return $text;
}
// 生成完整坐標
// 提取詩文末字坐標
// 提取〖詩文〗坐標

// JSON GROUP
/*
to work with 杜甫詩陣列:
1. from 坐標 to array path
2. to assign empty string to a cell
3. to attach a string to the last cell
4. to attach a string to 詩題、副題、序文
詩題 第一行
1-副題
序文 第三行
*/
/*
function 是合法完整坐標( array $坐標陣列, string $str ) : bool
{
	$文檔碼 = 提取頁碼( $str );
	
	if( !array_key_exists( $文檔碼, $坐標陣列 ) )
	{
		return false;
	}
	if( !in_array( $str, $坐標陣列[ $文檔碼 ] ) )
	{
		return false;
	}
	return true;
}
*/
function 是完整坐標( string $str ) : bool
{
	// 必須有坐標括號
	if( mb_strpos( $str, '〚' ) === false ||
		mb_strpos( $str, '〛' ) === false
	)
	{
		return false;
	}
	
	// strip the brackets
	$str = str_replace( '〚', '', 
		str_replace( '〛', '', $str ) );
	$match = array();
	// 4 or 5 parts within 〚〛
	$regex1 = '/\d{4}:/'; // 〚0003:〛
	$regex2 = '/\d{4}:\d+:/'; // 〚0013:2:〛
	$regex3 = '/\d{4}:\d+/'; // 〚0003:3〛
	$regex4 = '/\d{4}:\d+:\d+/'; // 〚0013:2:11〛
	$regex5 = '/\d{4}:\d+\.\d/'; // 〚0003:4.2〛
	$regex6 = '/\d{4}:\d+:\d+\.\d/'; // 〚0013:2:11.1〛
	$regex7 = '/\d{4}:\d+\.\d.\d+(-\d+)?/'; // 〚0003:5.1.2〛〚0003:5.1.2-4〛
	$regex8 = '/\d{4}:\d+:\d+\.\d.\d+(-\d+)?/'; // 〚0013:2:11.2.5〛〚0013:2:11.2.1-3〛

	$r = preg_match( $regex1, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}

	$r = preg_match( $regex2, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex3, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex4, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex5, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex6, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex7, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex8, $str, $match );
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}

	return false;
}
// 提取一個詩文詞組的坐標 〚0276:12.2.2〛,〚0276:12.2.2-4〛
/*
function 提取詩文坐標( string $詩文 ) : array
{
	$字數 = mb_strlen( $詩文 );
	$結構 = 提取數據結構( 數字對照陣列[ $字數 ] );
	
	if( array_key_exists( $詩文, $結構 ) )
	{
		return $結構[ $詩文 ];
	}
	else
	{
		return array( "杜甫詩中無「${詩文}」。" );
	}
}
*/

// 如果多於一個坐標，提取第一個
function 提取默詩碼詩文坐標( string $默詩碼, string $詩文 ) : string
{
	if( $詩文 == 詩題 || $詩文 == 序文 )
	{
		return $詩文;
	}
	
	$match = array();
	$r = preg_match( '/\d-副題/', $詩文, $match );
	
	if( $r && $match[ 0 ] == $詩文 )
	{
		return $詩文;
	}
	
	$result = array();
	$坐標s = 提取詩文坐標( $詩文 );
	
	if( $坐標s[ 0 ] != "杜甫詩中無「${詩文}」。"  )
	{
		foreach( $坐標s as $坐標 )
		{
			if( 提取頁碼( $坐標 ) == $默詩碼 )
			{
				array_push( $result, $坐標 );
			}
		}
		if( sizeof( $result ) > 0 )
			return $result[ 0 ];
	}
	return "${默詩碼}中無「${詩文}」。";
}

// 提取一組詩碼，每首詩中，都有「$詩文s」
function 提取詩文默詩碼( array $詩文s ) : array
{
	$temp1 = array();
	$temp2 = array();
	$temp3 = array();
	$result = array();
	$默詩碼 = array();
	
	foreach( $詩文s as $詩文 )
	{
		if( !array_key_exists( $詩文, $temp1 ) )
		{
			$temp1[ $詩文 ] = array();
			$temp2[ $詩文 ] = array();
			$result[ $詩文 ] = array();
		}
		$temp1[ $詩文 ] = 提取詩文坐標( $詩文 );
	}
	
	foreach( $temp1 as $文 => $標s )
	{
		foreach( $標s as $標 )
		{
			if( mb_strpos( $標, '〚' ) === false )
			{
				array_push( $result[ $文 ],  
					"杜甫詩中無「${文}」。" );
				return $result;
			}
			
			array_push( $temp2[ $文 ], 提取頁碼( $標 ) );
		}
	}

	foreach( $詩文s as $詩文 )
	{
		array_push( $temp3, $temp2[ $詩文 ] );
	}
	print_r( sizeof( $temp3 ) );
	if( sizeof( $temp3 ) == 1 )
	{
		return $temp3;
	}
	$dummy = array(); // fix the indexes
	return array_merge( 
		$dummy,
		array_unique( 
			array_intersect( ...$temp3 ) ) );
}

// 提取一首詩的陣列，該詩可以是詩組中的一首；「$詩碼」必須是默認詩碼
function 提取詩陣列( $詩碼 ) : array
{
	$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
	
	if( !in_array( $詩碼, $默認版本詩碼 ) )
	{
		echo "${詩碼} 不存在。";
		return array();
	}
		
	$杜甫詩陣列 = 提取數據結構( 杜甫詩陣列 );
	
	if( mb_strpos( $詩碼, '-' ) !== false )
	{
		$頁_首 = explode( '-', $詩碼 );
		return $杜甫詩陣列[ $頁_首[ 0 ] ][ $頁_首[ 1 ] ];
	}
	return $杜甫詩陣列[ $詩碼 ];
}
?>