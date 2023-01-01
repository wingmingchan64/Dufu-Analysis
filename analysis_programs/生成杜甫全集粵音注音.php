<?php
require_once( '常數.php' );
require_once( '函式.php' );
//require_once( "h:\\github\\Dufu-Analysis\\路徑_頁碼.php" );
require_once( "h:\\github\\Dufu-Analysis\\頁碼_詩題.php" );

// get all text file names
$file_names  = 提取杜甫文件名稱() ;
$new_content = "";

// get the text of the section
foreach( $file_names as $頁碼 => $from_file )
{
	$p = explode( "\\", $from_file );
	$file = trim( $p[ 4 ] );
	$頁碼 = substr( $file, 0, 4 );
	
	if( $頁碼 == "6111" ) // 卷二十一
	{
		break;
	}
	$詩題 = $頁碼_詩題[ "${頁碼}" ];

	$text_array = getSection( $from_file, '=粵' );
	$text = "";

	foreach( $text_array as $line )
	{
		if( mb_strpos( 
			$line, '陳永明《杜甫全集粵音注音》' ) !== false ||
			mb_strpos( $line, '【' ) !== false )
		{
			continue;
		}
		elseif( mb_strpos( $line, $詩題 ) !== false )
		{
			$text = $text . $頁碼 . ' ' . $line . "\n";
		}
		else
		{
			$text = $text . $line . "\n";
		}
	}
	
	//if( sizeof( $text_array ) > 0 )
	//{
	$new_content = $new_content . $text . 分隔線;
	//}
	
}

// write content to file
file_put_contents( 杜甫全集粵音注音, $new_content .
	file_get_contents( 'msg.txt', true ) );
?>