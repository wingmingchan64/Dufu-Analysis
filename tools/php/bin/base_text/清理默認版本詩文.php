<?php
/*
php h:\github\Dufu-Analysis\tools\php\bin\base_text\清理默認版本詩文.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$poem_dir = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
	'DuFu' . DIRECTORY_SEPARATOR .
	'默認版本' . DIRECTORY_SEPARATOR .
	'詩' . DIRECTORY_SEPARATOR;
if( !is_dir( $poem_dir ) )
{
    throw new RuntimeException( 'exceptions 詩文件夾: ' . $poem_dir );
}

$files = scandir( $poem_dir );
sort( $files, SORT_STRING );

$touched = array();
$touched[ '有括號' ] = array();

//$file = $poem_dir . "${文檔碼}.txt";
foreach( $files as $file )
{
	$path = $poem_dir  . $file;

	if(
		is_file( $path )
		&& preg_match( '/\\.txt$/i', $file )
	)
	{
		$文檔碼 = substr( $file, 0, 4 );
		$contents = file_get_contents( $path );
		// preserve spaces
		$contents = str_replace( ' ', '_', $contents );

		$lines = explode( NL, $contents );
		$contents = '';

		foreach( $lines as $line )
		{
			//$contents .= normalize( $line ) . NL;
			$line = 
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
				str_replace( "·", "", $line
			)))))))))))))));
			//echo $line, NL;
			
			$line = preg_replace( '/[\d]+ [\P{M}]+?\n/', "", $line );
			$line = preg_replace( '/[\s]+/', "", $line );
			$contents .= $line . NL;
		}

		$異體字 = 提取數據結構( 異體字 );
		$len = mb_strlen( $contents );
		$temp = '';
		$ytz = array_keys( $異體字 );

		// 逐字檢查，以規範字取代非規範字
		foreach( range( 0, $len - 1 ) as $pos )
		{
			$字 = mb_substr( $contents, $pos, 1 );
			
			if( in_array( $字, $ytz ) )
			{
				if( !array_key_exists( $文檔碼, $touched ) )
				{
					$touched[ $文檔碼 ] = array();
				}
				$touched[ $文檔碼 ][ $字 ] = $異體字[ $字 ];
				$temp .= $異體字[ $字 ];
			}
			else
			{
				$temp .= $字;
			}
		}
		
		$contents = str_replace( '_', ' ', $temp );
		
		if( preg_match( 夾注regex, $contents ) )
		{
			//$contents = preg_replace( 夾注regex, '', $contents );
			$touched[ '有括號' ][] = $文檔碼;
		}
		file_put_contents( $path, $contents );
	}
}

//print_r( $touched );
// restore spaces
?>

