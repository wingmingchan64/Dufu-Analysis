<?php
/*
 * Script: 生成杜甫全集.php
 * Usage:  php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集.php
 * Author: Wing Ming Chan
 * Updated: 2025-06-24
 */
require_once( '常數.php' );
require_once( '函式.php' );

/*
returns a path string like:
01 卷一 3-270\0003 望嶽.txt
*/
function truncate_path( $path )
{
    return substr( $path, strlen( 杜甫文件夾 ) );
}

/*
returns the text by 杜甫, including title, text, etc.
*/
function extract_main_text_from_files( $file_names )
{
    $content = "";

    foreach( $file_names as $from_file )
	{
        $handle = @fopen( $from_file, "r" );
        if( !$handle )
		{
            error_log( "⚠️ Cannot open file: $from_file" );
            continue;
        }

        while( ( $line = fgets( $handle ) ) !== false )
		{
            if( substr( $line, 0, 1 ) != '=' )
			{
                $content .= $line;
            }
			else
			{
                $content .= NL;
                break;
            }
        }

        fclose( $handle );
    }

    return $content;
}

function write_output_files( $content, $msg, $file_names )
{
    $output = 
		str_replace( '﻿', '', $content . $msg );

    // Output text files
    file_put_contents( 杜甫全集, $output );
    file_put_contents( 杜甫資料庫 . "杜甫全集_默認版本.php", $output );
    file_put_contents( 
		"h:" . DIRECTORY_SEPARATOR . "github" .
		DIRECTORY_SEPARATOR . "Dufu-Analysis" .
		DIRECTORY_SEPARATOR . "杜甫全集_默認版本.php", 
		$output );

    // Write relative paths of processed files
    $files = array_map( "truncate_path", $file_names );
    file_put_contents( 目錄, implode( NL, $files ) . NL . 
		NL . $msg );
}

// MAIN EXECUTION
$file_names   = 提取杜甫文件名稱();
$main_content = extract_main_text_from_files( $file_names );
$msg          = file_get_contents( 'msg.txt', true );

write_output_files( $main_content, $msg, $file_names );
echo "✅ 成功處理 " . count( $file_names ) . 
	" 首詩，整合文本已生成。" . NL;
?>