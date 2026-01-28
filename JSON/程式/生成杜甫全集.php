<?php
/*
 * Script: 生成杜甫全集.php
 * Usage:  php h:\github\Dufu-Analysis\JSON\程式\生成杜甫全集.php
 * Author: Wing Ming Chan
 * Updated: 2026-01-24
 */
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
/*
returns the text by 杜甫, including title, text, etc.
*/
/*
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
*/
function write_output_files( $content, $msg )
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
}

// MAIN EXECUTION
$content = '';
$詩路徑  = $JSON_BASE . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;
$文賦路徑  = $JSON_BASE . DIRECTORY_SEPARATOR .
	"文賦" . DIRECTORY_SEPARATOR;

foreach( $詩頁碼 as $頁 )
{
	$file_path = $詩路徑 . $頁 . ".txt";
	if( file_exists( $file_path ) )
	{
		$content .= file_get_contents( $file_path ) .
			NL . NL;
	}
}

$msg = file_get_contents( 'msg.txt', true );
write_output_files( $content, $msg );
echo "✅ 成功處理 " . count( $詩頁碼 ) . 
	" 首詩，整合文本已生成。" . NL;
?>