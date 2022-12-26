<?php
require_once( '常數.php' );
require_once( '函式.php' );

// get all text file names
$file_names  = 提取杜甫文件名稱() ;
$new_content = "";

// get the text of the section
foreach( $file_names as $from_file )
{
	$text_array = getSection( $from_file, '=粵' );
	
	if( sizeof( $text_array ) > 0 )
	{
		$new_content = 
			$new_content . implode( "\n", $text_array ) .
			分隔線;
	}
}

// write content to file
file_put_contents( 杜甫全集粵音注音, $new_content .
	file_get_contents( 'msg.txt', true ) );
?>