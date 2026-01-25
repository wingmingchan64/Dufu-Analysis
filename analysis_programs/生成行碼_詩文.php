<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成行碼_詩文.php
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
$JSON_詩BASE = 
	$JSON_BASE . DIRECTORY_SEPARATOR . "詩";
$JSON_行碼_詩文BASE = 
	$JSON_詩BASE . DIRECTORY_SEPARATOR . "行碼_詩文";
$DATA = new JsonDataLoader( $JSON_BASE );
$詩頁碼 = $DATA->get( "詩頁碼" );
$詩組_詩題 = $DATA->get( "詩組_詩題" );
$詩_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"杜甫全集" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;
$result = array();
$副題 = array();

foreach( $詩頁碼 as $頁 )
{
	$首 = 0;
	$行 = 0;
	$詩組 = false;
	
	$詩文檔 = $詩_BASE . $頁 . ".txt";
	$handle = @fopen( $詩文檔, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$詩組 = true;
	}

	// read first line
	while( ( $line = fgets( $handle ) ) !== false )
	{
		if( $詩組 )
		{
			$行++;
			if( in_array( 
				intval( $行 ), $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				$首++;
			}
			$行碼template = "〚${頁}:${首}:${行}〛";
			
			if( in_array( 
				intval( $行 ), $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				$副題[ $行碼template ] = trim( $line );
			}
		}
		else
		{
			$行++;
			$行碼template = "〚${頁}:${行}〛";
		}

		$result[ $行碼template ] = trim( $line );
	}

	fclose( $handle );
	
}
$json = json_encode(
	$result,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"行碼_詩文.json",
	$json . PHP_EOL );

$json = json_encode(
    $副題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"行碼_副題.json",
	$json . PHP_EOL );

?>