<?php
/*
*/
require_once( "h:\\github\\Dufu-Analysis\\用字_頻率.php" );

$部首_folder_path = "h:\\github\\unicode\\";
$部首_file_array = array();
$部首 = array();
$out_file = "h:\\github\\Dufu-Analysis\\部首_用字.php";

if( is_dir( $部首_folder_path ) )
{
	// store all text file names
	$files = scandir( $部首_folder_path );
		
	foreach( $files as $file )
	{
		if( $file != '.' && $file != '..' &&
			mb_strpos( $file, '部.txt' ) !== false )
		{
			array_push( $部首_file_array, $file );
			$部首[ substr( substr( $file, 3 ), 0, -4 ) ] = 
				array();
		}
	}
}
//var_dump( $部首 );
$chars = array_keys( $用字_頻率 );

foreach( $chars as $char )
{
	if( $char == "部" )
	{
		if( !in_array( $char, $部首[ "邑部" ] ) )
		{
			array_push( $部首[ "邑部" ], $char );
		}
	}

	foreach( $部首_file_array as $部首_file )
	{
		$内容 = 
			file_get_contents( $部首_folder_path . $部首_file );
	
		if( mb_strpos( $内容, $char ) !== false )
		{
			
			$r = substr( substr( $部首_file, 3 ), 0, -4 );
			
			if( !array_key_exists( $r, $部首 ) )
			{
				echo "Something wrong!!!", "\n";
				exit;
			}
			
			if( !in_array( $char, $部首[ $r ] ) )
			{
				array_push( $部首[ $r ], $char );
			}
			break;
		}
	}
}

foreach( $部首 as $部 => $字 )
{
	sort( $字 );
	$部首[ $部 ] = $字;
}
$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：杜甫詩中所用字，按部首、筆畫數排列。
*/
\$部首_用字=array(\n";

foreach( $部首 as $部 => $字 )
{
	$code = $code . "\"$部\"=>array(";
	
	foreach( $字 as $c )
	{
		$code = $code . "\"$c\",";
	}
	if( !empty( $字 ) )
	{
		$code = substr( $code, 0, -1 );
	}
	$code = $code . "),\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";

file_put_contents( $out_file, $code );
?>
