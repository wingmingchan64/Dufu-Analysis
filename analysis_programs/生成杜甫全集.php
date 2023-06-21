<?php
require_once( '常數.php' );
require_once( '函式.php' );

// get all text file names
$file_names  = 提取杜甫文件名稱();
$new_content = "";

// the first section isn't marked, and getSection doesn't work
// open each text file, read and store text up to
// the first maker
foreach( $file_names as $from_file )
{
	$handle = fopen( $from_file, "r" );

	if( $handle )
	{
		// read a line at a time and store it
		while ( ( $line = fgets( $handle ) ) !== false )
		{
			if( substr( $line, 0, 1 ) != '=' )
			{
				$new_content .= $line;
			}
			else
			{
				$new_content .= "\n";
				break;
			}
		}
		fclose( $handle );
	}
}

function truncate_path( $path )
{
	return substr( $path, strlen( 杜甫文件夾 ) );
}

// add msg and write to files
$msg = file_get_contents( 'msg.txt', true );
file_put_contents( 杜甫全集, $new_content . $msg );
file_put_contents( 杜甫資料庫 . "杜甫全集_默認版本.php", $new_content . $msg );
file_put_contents( "h:\\github\\Dufu-Analysis\\" . "杜甫全集_默認版本.php", $new_content . $msg );

$files = array_map( "truncate_path", $file_names );
file_put_contents( 目錄, implode( "\n", $files ) .
	"\n\n" . $msg );
?>