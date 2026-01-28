<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成默認版本詩碼.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認版本詩碼 = array();
$dir = 	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"默認版本" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;

//print_r( $詩頁碼 );

foreach( $詩頁碼 as $頁 )
{
	//$頁 = substr( $頁, 0, -4 );
		
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$counter = 1;
		
		foreach( $詩組_詩題[ $頁 ][ 1 ] as $dummy )
		{
			array_push( $默認版本詩碼,
				$頁 . '-' . $counter );
			$counter++;
		}
	}
	else
	{
		array_push( $默認版本詩碼, $頁 );
	}
}
//print_r( $默認版本詩碼 );

$json = json_encode(
    $默認版本詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"數據結構" . DIRECTORY_SEPARATOR .
	"默認版本詩碼.json",
	$json . PHP_EOL );
?>
