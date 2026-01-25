<?php
/*
 * Script: 生成詩頁碼_詩題.php，生成兩個文檔
 * Usage:  php h:\github\Dufu-Analysis\analysis_programs\生成詩頁碼_詩題.php
 * Author: Wing Ming Chan
 * Updated: 2026-01-25
 */
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"loader.php" );
$JSON_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .	
	"杜甫全集";
$詩_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"杜甫全集" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;

$DATA = new JsonDataLoader( $JSON_BASE );
$詩頁碼   = $DATA->get( "詩頁碼" );

//require_once( 杜甫資料庫 . '詩文件夾路徑.php' );

$詩頁碼_詩題 = array();
$詩題_詩頁碼 = array();
$詩頁碼_題注 = array();

foreach( $詩頁碼 as $頁 )
{
	$詩文檔 = $詩_BASE . $頁 . ".txt";
	$handle = @fopen( $詩文檔, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}

	// read first line
	if( ( $line = fgets( $handle ) ) !== false )
	{
		$題注 = array();
		$result = preg_match( 夾注regex, $line, $題注 );
		
		if( $result && count( $題注 ) > 0 )
		{
			$詩頁碼_題注[ $頁 ] = $題注[ 0 ];
			//print_r( $題注 );
		}
		
		$line = 
			trim( mb_substr( 
				preg_replace( 夾注regex, '', $line ),
				5 ) );
		$詩頁碼_詩題[ $頁 ] = $line;
		$詩題_詩頁碼[ $line ] = $頁;
	}

	fclose( $handle );
}

$json = json_encode(
    $詩頁碼_詩題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"詩頁碼_詩題.json",
	$json . PHP_EOL );
	
$json = json_encode(
    $詩題_詩頁碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"詩題_詩頁碼.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩頁碼_題注,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"詩頁碼_題注.json",
	$json . PHP_EOL );
?>