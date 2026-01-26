<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成蕭滌非《杜甫全集校注》詩碼.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$詩碼_詩頁碼 = array();
$詩頁碼_詩碼 = array();
$counter = 1;

foreach( $詩頁碼 as $頁 )
{
	// skip 1989, this does not exist in 蕭
	if( $頁 == '1989' )
	{
		continue;
	}
	elseif( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$行s = $詩組_詩題[ $頁 ][ 1 ];
		$size = count( $行s );
		
		for( $i = 1; $i <= $size; $i++ )
		{
			$詩碼 = pad_with_zeros( $counter ) .
				"-${i}";
			$詩碼_詩頁碼[ $詩碼 ] = $頁;
			
			if( !array_key_exists( $頁, $詩頁碼_詩碼 ) )
			{
				$詩頁碼_詩碼[ $頁 ] = array();
			}
			array_push( $詩頁碼_詩碼[ $頁 ], $詩碼 );
		}
	}
	else
	{
		$詩碼 = pad_with_zeros( $counter );
		$詩碼_詩頁碼[ $詩碼 ] = $頁;
		$詩頁碼_詩碼[ $頁 ] = $詩碼;
	}
	
	$counter++;
}

function pad_with_zeros( int $v ) : string
{
	return str_pad( $v, 4, '0', STR_PAD_LEFT );
}

$json = json_encode(
    $詩碼_詩頁碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"蕭滌非《杜甫全集校注》" . DIRECTORY_SEPARATOR .
	"詩碼_詩頁碼.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩頁碼_詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"蕭滌非《杜甫全集校注》" . DIRECTORY_SEPARATOR .
	"詩頁碼_詩碼.json",
	$json . PHP_EOL );

?>
