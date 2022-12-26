<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\詩組_詩題.php' );
require_once( 'h:\github\Dufu-Analysis\詩文件夾路徑.php' );
require_once( 'h:\github\Dufu-Analysis\帶序文之詩歌.php' );

$create_pages     = true;
//$create_pages     = false;
// 0003
$page             = array(); 
// "0003"=>'h:\github\DuFu\01 卷一 3-270\0003 望嶽.txt'
$page_path        = array();
$normalized_text  = "";
$副題              = array();

if( is_dir( 杜甫文件夾 ) )
{
	// vol 1-20
	foreach( $詩文件夾路徑 as $folder )
	{
		// store all text file names
		$files = scandir( $folder );
		
		// get page numbers
		foreach( $files as $file )
		{
			if( $file != '.' && $file != '..' &&
				str_contains( $file, '.txt' )
			)
			{
				array_push( $page, substr( $file, 0, 4 ) );
				$page_path[ substr( $file, 0, 4 ) ] =
					$folder . $file;
			}
		}
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：頁碼=>詩篇文檔所在路徑。
*/
\$頁碼_路徑=array(\n";

foreach( $page_path as $p => $path )
{
	$code = $code . '"' . $p . "\"=>'" .
		$path . "',\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\頁碼_路徑.php', $code );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：詩篇文檔所在路徑=>頁碼。
*/
\$路徑_頁碼=array(\n";

foreach( $page_path as $p => $path )
{
	$code = $code . '"' . $path . "\"=>'" .
		$p . "',\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\路徑_頁碼.php', $code );


$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：頁碼。
*/
\$頁碼=array(\n";

foreach( $page as $p )
{
	$code = $code . '"' . $p . "\",\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( 'h:\github\Dufu-Analysis\頁碼.php', $code );

// create the php pages
require_once( 'h:\github\Dufu-Analysis\頁碼_詩題.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼_路徑.php' );

$multiple_verse = false;

if( is_dir ( 詩集文件夾 ) )
{
	chmod( 詩集文件夾, 0777 );
	
	foreach( $page as $p )
	{
		
		if( array_key_exists( $p, $詩組_詩題 ) )
		{
			$multiple_verse = true;
		}
		else
		{
			$multiple_verse = false;
		}
		
		$poem  = getPoem( $page_path[ $p ] );
		$normalized_text .= $poem;
		// 句
		$lines = explode( '。', $poem );
		$code  = 
"<?php
/*
生成：本文檔用 PHP 生成。
說明：詩篇的相關内容。
*/
\$content=array(\n" .
		//詩題
			"\"詩題\"=>\"$頁碼_詩題[$p]\",\n" .
		//詩文
			"\"詩文\"=>\"" . $poem . "\",\n" .
		//詩句
		"\"詩句\"=>array(\n";
		foreach( $lines as $l )
		{
			if( $l == '' )
				continue;
			$code = $code . "\"" . $l . "\",";
		}
		
		$code = substr( $code, 0, -1 );				
		$code = $code . "),";
		
		//題注
		$annotation = getAnnotation( $page_path[ $p ] );
		if( $annotation != '' )
		{
			$code = $code . "\n\"題注\"=>\"" . $annotation . "\",";
		}
		
		//序言
		$preface = getPreface( $page_path[ $p ] );
		if( $preface != '' )
		{
			$code = $code . "\n\"序言\"=>\"" . trim( $preface ) . "\",";
		}
		
		//行碼（内容所在的第幾行）
		$ln_array = getLN( $page_path[ $p ] );
		$code = $code . "\n\"行碼\"=>array(\n";
		
		if( $multiple_verse )
		{
			$poem_lines = array(); // used by multiple_verse
		}

		foreach( $ln_array as $ln => $l )
		{
			if( $multiple_verse )
			{
				$poem_lines[ trim( $ln, "〚〛" ) ] = trim( $l );
				//array_push( $poem_lines, trim( $l ) );
			}
			$l = normalize( trim( $l ) );
			$code = $code . "\"${ln}\"=>\"$l\",\n";
		}
		$code = substr( $code, 0, -1 );	
		$code = $code . "\n),";
				
		//坐標_句
		$code = $code . "\n\"坐標_句\"=>array(\n";

		foreach( $ln_array as $ln => $l )
		{
			$l = normalize( trim( $l ) );
			$verses = explode( '。', $l );
			// the line number
			$ln   = trim( $ln, '〚〛' );
			if( intval( $ln ) == 1 ) // title
			{
				continue;
			}
			
			if( $multiple_verse )
			{
				$副題_array = $詩組_詩題[ $p ][ 1 ];
				$order_of_poem = 
					getOrderOfPoem( $副題_array, intval( $ln ) );
				$order_of_poem = "${order_of_poem}:";
			}
			else
			{
				$order_of_poem = "";
			}
			
			if( is_array( $verses ) && sizeof( $verses ) == 2 )
			{
				// create 坐標_句
			$ln1  = "〚${p}:${order_of_poem}${ln}.1〛";
				$code = $code . "\"${ln1}\"=>\"" . 
					$verses[ 0 ] . "\",\n";
			}
			else
			if( is_array( $verses ) && sizeof( $verses ) == 3 )
			{
				// create 坐標_句
				$ln1 = "〚${p}:${order_of_poem}${ln}.1〛";
				$ln2 = "〚${p}:${order_of_poem}${ln}.2〛";
				$code = $code . "\"${ln1}\"=>\"" . 
					$verses[ 0 ] . "\",\n";
				$code = $code . "\"${ln2}\"=>\"" . 
					$verses[ 1 ] . "\",\n";
			}
		}
		
		$code = $code . "),\n";
		
		if( $multiple_verse )
		{
			$poem_array = array();
			
			$副題_array = $詩組_詩題[ $p ][ 1 ];
			// [ 3 10 ]
			$first  = $副題_array[ 0 ];
			$second = $副題_array[ 1 ];
			$count  = 1;
			$current_title = "";
			$副題 = array();
			
			foreach( $ln_array as $ln => $l )
			{
				$ln = intval( trim( $ln, '〚〛' ) );
				$l = trim( $l );
				
				if( $ln < $first || $l == "" )
				{
					continue;
				}
				elseif( $ln == $first )
				{
					$current_title = $l;
					$poem_array[ $current_title ] = array();
					array_push( $副題, $current_title );
				}
				elseif( $ln > $first && $ln < $second )
				{
					array_push( 
						$poem_array[ $current_title ], $l );
				}
				elseif( $ln == $second ) // reach second
				{
					$first = $second;
					$current_title = $l;
					$count++;
					
					if( $count < sizeof( $副題_array ) )
					{
						$second = $副題_array[ $count ];
					}
					
					$poem_array[ $current_title ] = array();
					array_push( $副題, $current_title );
				}
				elseif( $first == $second )
				{
					array_push( 
						$poem_array[ $current_title ], $l );
				}
			}
			
			$code = $code . "\n\"副題\"=>array(\n";
			foreach( $副題 as $t )
			{
				$code = $code . "\"${t}\",";
			}
			$code = substr( $code, 0, -1 );
			$code = $code . "),\n";
			
			$code = $code . "\"詩歌\"=>array(\n";
			foreach( $poem_array as $poem => $poem_lines )
			{
				$code = $code . "\"${poem}\"=>array(\n";
				foreach( $poem_lines as $p_line )
				{
					$code = $code . "\"${p_line}\",";
				}
				$code = substr( $code, 0, -1 );
				$code = $code . "),\n";
			}
			$code = $code . "),";
		}
		$code = substr( $code, 0, -1 );
		
		//$code = substr( $code, 0, -1 );		
		$code = $code . "\n);\n?>";
		
		if( $create_pages )
		{
			file_put_contents( 詩集文件夾 . $p . '.php',
			$code );
		}// end create pages
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：清理乾淨的詩篇内容，不包括詩題、序言、注文等，也不包括文集中的内容。
*/
\$text=\"$normalized_text\"
?>";
file_put_contents( 'h:\github\Dufu-Analysis\normalized.php',
	$code );
?>